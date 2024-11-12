<?php

namespace App\Services;

use App\Models\MeasurementModel;
use App\Models\CleanFoodModel;
use App\Models\MealPlanModel;
use App\Models\MealPlanLogModel;

class GeneticAlgorithmService {
    // pengecekan prediabetes
    public function checkPrediabetes($measurement){
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
        $protein = ($tdee * 0.15) / 4;  // 1 gram protein = 4 kalori
        $fats = ($tdee * 0.30) / 9;  // 1 gram lemak = 9 kalori
        $carbs = ($tdee * 0.55) / 4;  // 1 gram karbohidrat = 4 kalori
        $fiber = $this->calculateFiberNeed($age, $gender);

        $result = [
            'calorie' => $tdee,
            'protein' => $protein,
            'fats' => $fats,
            'carbs' => $carbs,
            'fiber' => $fiber,
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
    public function generateDailyMealPlan($personalNeed, $day)
    {
        $populationSize = 50;
        $generations = 50;

        // Inisialisasi populasi dengan rencana makan acak
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $population[] = $this->randomMealPlan();
        }

        for ($generation = 0; $generation < $generations; $generation++) {
            // Hitung fitness untuk setiap meal plan
            $fitnessScores = [];
            foreach ($population as $mealPlan) {
                $fitnessScores[] = $this->calculateFitness($mealPlan, $personalNeed);
            }

            // Seleksi dan tentukan populasi terbaik berdasarkan nilai fitness
            $population = $this->selectBest($population, $fitnessScores);

            // Buat generasi baru melalui crossover dan mutasi
            $population = $this->crossoverAndMutate($population);
        }

        // Ambil meal plan terbaik dengan fitness tertinggi
        return $this->getBestMealPlan($population);
    }

    // Menyimpan meal plan yang sudah dibuat
    public function saveMealPlan($measurementId,$userId,$day,$mealPlanForDay){
        MealPlanModel::updateOrCreate(
            ['measurement_id' => $measurementId, 'user_id' => $userId, 'day' => $day],
            ['meal_plan' => json_encode($mealPlanForDay)]
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
        return round(($food->calorie / 100) * $portion, 2);
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
            'calorie' => 0,
            'protein' => 0,
            'fats' => 0,
            'carbs' => 0,
            'fiber' => 0,
        ];

        foreach ($mealPlan as $meal) {
            foreach ($meal as $food) {
                $portion = (int)filter_var($food['portion'], FILTER_SANITIZE_NUMBER_INT);
                $totalNutrients['calorie'] += $this->calculateCalories((object)$food, $portion);
                $totalNutrients['protein'] += ($food['protein'] / 100) * $portion;
                $totalNutrients['fats'] += ($food['fats'] / 100) * $portion;
                $totalNutrients['carbs'] += ($food['carbs'] / 100) * $portion;
                $totalNutrients['fiber'] += ($food['fiber'] / 100) * $portion;
            }
        }

        $uniqueFoodGroups = [];
        foreach ($mealPlan as $meal) {
            foreach ($meal as $food) {
                $uniqueFoodGroups[$food['food_group']] = true;
            }
        }
        $diversityScore = count($uniqueFoodGroups);

        $fitness = 0;
        $fitness += abs($personalNeed['calorie'] - $totalNutrients['calorie']);
        $fitness += abs($personalNeed['protein'] - $totalNutrients['protein']);
        $fitness += abs($personalNeed['fats'] - $totalNutrients['fats']);
        $fitness += abs($personalNeed['carbs'] - $totalNutrients['carbs']);
        $fitness += abs($personalNeed['fiber'] - $totalNutrients['fiber']);

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
                    'food_name' => $food->food_name,
                    'food_group' => $food->food_group_id,
                    'portion' => $portion . ' g',
                    'calories' => $this->calculateCalories($food, $portion),
                    'calorie' => $food->calorie,
                    'protein' => $food->protein,
                    'fats' => $food->fats,
                    'carbs' => $food->carbs,
                    'fiber' => $food->fiber
                ];
            }
        }

        return $selectedFoods;
    }

    public function randomMealPlan()
    {
        return [
            'breakfast' => $this->selectUniqueFoods(1, [10, 4, 9, 1, 2]),
            'lunch' => $this->selectUniqueFoods(1, [10, 4, 9, 1, 2]),
            'dinner' => $this->selectUniqueFoods(1, [10, 4, 9, 1, 2]),
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
                $child[$mealType] = $this->selectUniqueFoods(1, [10, 4, 9, 1, 2]);
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
