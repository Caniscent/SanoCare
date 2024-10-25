<?php

namespace App\Services;

use App\Models\MeasurementModel;
use App\Models\CleanFoodModel;
use App\Models\MealPlanModel;
use App\Models\MealPlanLogModel;

class GeneticAlgorithmService {
    // pengecekan prediabetes
    public function checkPrediabetes($measurement){
        // $firstMeasurement = $measurement->first();
        // if(!$firstMeasurement){
        //     abort(404, 'Tidak ditemukan');
        // }
        $bloodSugar = $measurement->first()->sugar_blood;
        $testMethod = $measurement->first()->testMethod->method;


        if ($testMethod == 'Puasa') {
            if ($bloodSugar >= 100 && $bloodSugar <= 125) {
            } else if ($bloodSugar > 125) {
                abort(403, 'Diabetes');
            }
        } else if ($testMethod == 'TTGO') {
            if ($bloodSugar >= 140 && $bloodSugar <= 199) {
            } else if ($bloodSugar > 199) {
                abort(403, 'Diabetes');
            }
        }
    }

    // menghitung kebutuhan personal dari user
    public function calculatePersonalNeed($measurement)
    {
        $user = $measurement->first()->user;
        $measurement = $measurement->first();
        $age = $user->age;
        $gender = $user->gender;
        $height = $measurement->height;
        $weight = $measurement->weight;

        $activityCategory = $measurement->activityLevel->activity;
        $activityFactor = $this->getActivityFactor($activityCategory);

        // Menghitung BMR (Basal Metabolic Rate) dengan rumus Mifflin-St Jeor
        if ($gender === 'laki-laki') {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
        } else {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
        }

        // Menghitung TDEE (Total Daily Energy Expenditure) berdasarkan aktivitas fisik
        $tdee = $bmr * $activityFactor;

        // Distribusi Makronutrien
        $protein_g = ($tdee * 0.15) / 4;  // 1 gram protein = 4 kalori
        $fat_g = ($tdee * 0.30) / 9;  // 1 gram lemak = 9 kalori
        $carbs_g = ($tdee * 0.55) / 4;  // 1 gram karbohidrat = 4 kalori
        $fiber_g = $this->calculateFiberNeed($age, $gender);

        $result = [
            'energy_kal' => $tdee,
            'protein_g' => $protein_g,
            'fat_g' => $fat_g,
            'carbs_g' => $carbs_g,
            'fiber_g' => $fiber_g,
        ];

        return $result;
    }

    // Membuat meal plan untuk 1 minggu
    public function generateMealPlan($personalNeed)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyMealPlan = [];

        foreach ($days as $day) {
            $weeklyMealPlan[$day] = $this->generateDailyMealPlan($personalNeed, $day);
        }

        return $weeklyMealPlan;
    }

    // Membuat meal plan harian
    public function generateDailyMealPlan($personalNeed)
    {
        $populationSize = 50;
        $generations = 50;

        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $population[] = $this->randomMealPlan();
        }

        for ($generation = 0; $generation < $generations; $generation++) {
            $fitness = array_map(function ($mealPlan) use ($personalNeed) {
                return $this->calculateFitness($mealPlan, $personalNeed);
            }, $population);

            $population = $this->selectBest($population, $fitness);
            $population = $this->crossoverAndMutate($population);
        }

        return $this->getBestMealPlan($population);
    }

    // Menyimpan meal plan yang sudah dibuat
    public function saveMealPlan($userId,$day,$mealPlanForDay){
        MealPlanModel::updateOrCreate(
            ['user_id' => $userId, 'day' => $day],
            ['meal_plans' => json_encode($mealPlanForDay)]
        );
    }


    // Menentukan skala dari aktivitas
    public function getActivityFactor($activityCategory)
    {
        switch ($activityCategory) {
            case 'Sangat Ringan':
                return 1.2;
            case 'Ringan':
                return 1.375;
            case 'Sedang':
                return 1.55;
            case 'Berat':
                return 1.725;
            default:
                return 1.2;
        }
    }

    // Menghitung kalori yang dibutuhkan user
    public function calculateCalories($food, $portion)
    {
        return round(($food->energy_kal / 100) * $portion, 2);
    }

    // Menghitung serat yang dibutuhkan user
    public function calculateFiberNeed($age, $gender)
    {
        if ($gender === 'laki-laki') {
            return $age <= 50 ? 38 : 30;
        } else {
            return $age <= 50 ? 25 : 21;
        }
    }

    // Menghitung fitness
    public function calculateFitness($mealPlan, $personalNeed)
    {
        $totalNutrients = [
            'energy_kal' => 0,
            'protein_g' => 0,
            'fat_g' => 0,
            'carbs_g' => 0,
            'fiber_g' => 0,
        ];

        foreach ($mealPlan as $meal) {
            foreach ($meal as $food) {
                $portion = (int)filter_var($food['portion'], FILTER_SANITIZE_NUMBER_INT);
                $totalNutrients['energy_kal'] += $this->calculateCalories((object)$food, $portion);
                $totalNutrients['protein_g'] += ($food['protein'] / 100) * $portion;
                $totalNutrients['fat_g'] += ($food['fats'] / 100) * $portion;
                $totalNutrients['carbs_g'] += ($food['carbs'] / 100) * $portion;
                $totalNutrients['fiber_g'] += ($food['fiber'] / 100) * $portion;
            }
        }

        $uniqueFoodGroups = [];
        foreach ($mealPlan as $meal) {
            foreach ($meal as $food) {
                $uniqueFoodGroups[$food['food_group_id']] = true;
            }
        }
        $diversityScore = count($uniqueFoodGroups);

        $fitness = 0;
        $fitness += abs($personalNeed['energy_kal'] - $totalNutrients['energy_kal']);
        $fitness += abs($personalNeed['protein_g'] - $totalNutrients['protein_g']);
        $fitness += abs($personalNeed['fat_g'] - $totalNutrients['fat_g']);
        $fitness += abs($personalNeed['carbs_g'] - $totalNutrients['carbs_g']);
        $fitness += abs($personalNeed['fiber_g'] - $totalNutrients['fiber_g']);

        $fitness -= $diversityScore;

        return 1 / ($fitness + 1);
    }

    public function selectUniqueFoods($count, $foodGroups)
    {
        $selectedFoods = [];
        foreach ($foodGroups as $group) {
            $foods = CleanFoodModel::where('food_group_id', $group)->inRandomOrder()->take($count)->get();
            foreach ($foods as $food) {
                $portion = rand(100, 200);
                $selectedFoods[] = [
                    'ingredients_name' => $food->ingredients_name,
                    'food_group' => $food->food_group_id,
                    'portion' => $portion . ' g',
                    'energy_kal' => $this->calculateCalories($food, $portion),
                    'calories' => $food->calorie,
                    'protein_g' => $food->protein,
                    'fat_g' => $food->fats,
                    'carbs_g' => $food->carbs,
                    'fiber_g' => $food->fiber
                ];
            }
        }

        return $selectedFoods;
    }

    public function randomMealPlan()
    {
        return [
            'breakfast' => $this->selectUniqueFoods(1, [10 | 13, 3 | 4 | 5 | 8 | 12, 1, 9, 2 | 6 | 7 | 11]),
            'lunch' => $this->selectUniqueFoods(1,[10 | 13, 3 | 4 | 5 | 8 | 12, 1, 9, 2 | 6 | 7 | 11]),
            'dinner' => $this->selectUniqueFoods(1, [10 | 13, 3 | 4 | 5 | 8 | 12, 1, 9, 2 | 6 | 7 | 11]),
        ];
    }

    // Memilih populasi yang terbaik (tertinggi)
    public function selectBest($population, $fitness)
    {
        array_multisort($fitness, SORT_DESC, $population);

        return array_slice($population, 0, count($population) / 2);
    }

    public function crossoverAndMutate($population)
    {
        $newPopulation = [];

        while (count($newPopulation) < count($population) * 2) {
            $parent1 = $population[array_rand($population)];
            $parent2 = $population[array_rand($population)];

            $child = [
                'breakfast' => rand(0, 1) ? $parent1['breakfast'] : $parent2['breakfast'],
                'lunch' => rand(0, 1) ? $parent1['lunch'] : $parent2['lunch'],
                'dinner' => rand(0, 1) ? $parent1['dinner'] : $parent2['dinner'],
            ];

            if (rand(0, 100) < 10) {
                $mealType = ['breakfast', 'lunch', 'dinner'][array_rand(['breakfast', 'lunch', 'dinner'])];
                $child[$mealType] = $this->selectUniqueFoods(1, [10 | 13, 3 | 4 | 5 | 8 | 12, 1, 9, 2 | 6 | 7 | 11]);
            }

            $newPopulation[] = $child;
        }

        return $newPopulation;
    }

    public function getBestMealPlan($population)
    {
        return $population[0];
    }
}
