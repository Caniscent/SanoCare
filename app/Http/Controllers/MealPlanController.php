<?php

namespace App\Http\Controllers;

use App\Models\ChecksModel;
use App\Models\ActivityModel;
use App\Models\TestMethodModel;
use App\Models\FoodModel;
use App\Models\HistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        if ($userId === null) {
            return redirect()->route('login');
        }

        $check = ChecksModel::where('user_id', $userId)
            ->with('user', 'activityCategories', 'testMethod')
            ->get();

        if ($check->count() === 0) {
            return view('pages.check.index', ['check' => $check, 'mealPlan' => null]);
        }

        $this->checkPrediabetes($check);

        $personalNeed = $this->calculatePersonalNeed($check);
        $selectedDay = $request->get('day', now()->locale('id')->format('l'));
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $currentDay = array_search($selectedDay, $days);
        $prevDay = $days[($currentDay - 1 + count($days)) % count($days)];
        $nextDay = $days[($currentDay + 1) % count($days)];

        // Cek meal plan di tabel meal_plan_histories
        $mealPlanHistoryCount = HistoryModel::where('user_id', $userId)->count();

        if ($mealPlanHistoryCount < 7) {
            foreach ($days as $day) {
                $weeklyMealPlan = $this->generateMealPlan($personalNeed);
                $this->saveMealPlanHistory($userId, $check->id,$day, $weeklyMealPlan[$day]);
            }
        }

        // Ambil meal plan dari db
        $mealPlan = HistoryModel::where('user_id', $userId)
            ->get()
            ->keyBy('day')
            ->map(function ($mealPlanHistory) {
                return json_decode($mealPlanHistory->meal_plan, true);
            });

        return view('pages.check.index', compact('check', 'mealPlan', 'selectedDay', 'prevDay', 'nextDay'));

    }

    private function checkPrediabetes($check){
        $bloodSugar = $check->first()->sugar_content;
        $testMethod = $check->first()->testMethod->method;

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

    private function calculatePersonalNeed($check)
    {
        $user = $check->first()->user;
        $check = $check->first();
        $age = $user->age;
        $gender = $user->gender;
        $height = $check->height;
        $weight = $check->weight;

        $activityCategory = $check->activityCategories->activity;
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

    private function getActivityFactor($activityCategory)
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

    private function calculateFiberNeed($age, $gender)
    {
        if ($gender === 'laki-laki') {
            return $age <= 50 ? 38 : 30;
        } else {
            return $age <= 50 ? 25 : 21;
        }
    }

    // Membuat meal plan untuk 1 minggu
    private function generateMealPlan($personalNeed)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyMealPlan = [];

        foreach ($days as $day) {
            $weeklyMealPlan[$day] = $this->generateDailyMealPlan($personalNeed, $day);
        }

        return $weeklyMealPlan;
    }

    // Menghasilkan meal plan harian
    private function generateDailyMealPlan($personalNeed, $day)
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

    // Membuat meal plan random berdasarkan masing masing food group
    private function randomMealPlan()
    {
        return [
            'breakfast' => $this->selectUniqueFoods(1, ['serealia', 'daging dan unggas', 'biji bijian', 'sayuran', 'buah']),
            'lunch' => $this->selectUniqueFoods(1, ['serealia', 'daging dan unggas', 'biji bijian', 'sayuran', 'buah']),
            'dinner' => $this->selectUniqueFoods(1, ['serealia', 'daging dan unggas', 'biji bijian', 'sayuran', 'buah']),
        ];
    }

    private function selectUniqueFoods($count, $foodGroups)
    {
        $selectedFoods = [];
        foreach ($foodGroups as $group) {
            $foods = FoodModel::where('food_group', $group)->inRandomOrder()->take($count)->get();
            foreach ($foods as $food) {
                $portion = rand(100, 200);
                $selectedFoods[] = [
                    'ingredients_name' => $food->ingredients_name,
                    'food_group' => $food->food_group,
                    'portion' => $portion . ' g',
                    'calories' => $this->calculateCalories($food, $portion),
                    'energy_kal' => $food->energy_kal,
                    'protein_g' => $food->protein_g,
                    'fat_g' => $food->fat_g,
                    'carbs_g' => $food->carbs_g,
                    'fiber_g' => $food->fiber_g
                ];
            }
        }

        return $selectedFoods;
    }

    private function calculateCalories($food, $portion)
    {
        return round(($food->energy_kal / 100) * $portion, 2);
    }

    private function calculateFitness($mealPlan, $personalNeed)
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
                $totalNutrients['protein_g'] += ($food['protein_g'] / 100) * $portion;
                $totalNutrients['fat_g'] += ($food['fat_g'] / 100) * $portion;
                $totalNutrients['carbs_g'] += ($food['carbs_g'] / 100) * $portion;
                $totalNutrients['fiber_g'] += ($food['fiber_g'] / 100) * $portion;
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
        $fitness += abs($personalNeed['energy_kal'] - $totalNutrients['energy_kal']);
        $fitness += abs($personalNeed['protein_g'] - $totalNutrients['protein_g']);
        $fitness += abs($personalNeed['fat_g'] - $totalNutrients['fat_g']);
        $fitness += abs($personalNeed['carbs_g'] - $totalNutrients['carbs_g']);
        $fitness += abs($personalNeed['fiber_g'] - $totalNutrients['fiber_g']);

        $fitness -= $diversityScore;

        return 1 / ($fitness + 1);
    }

    private function getBestMealPlan($population)
    {
        return $population[0];
    }

    private function selectBest($population, $fitness)
    {
        array_multisort($fitness, SORT_DESC, $population);

        return array_slice($population, 0, count($population) / 2);
    }

    private function crossoverAndMutate($population)
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
                $child[$mealType] = $this->selectUniqueFoods(1, ['serealia', 'daging dan unggas', 'biji bijian', 'sayuran', 'buah']);
            }

            $newPopulation[] = $child;
        }

        return $newPopulation;
    }


    private function saveMealPlanHistory($userId,$checkId,$day,$mealPlanForDay){
        HistoryModel::updateOrCreate(
            ['user_id' => $userId, 'check_id' => $checkId, 'day' => $day],
            ['meal_plan' => json_encode($mealPlanForDay)]
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = ActivityModel::all();
        $test_methods = TestMethodModel::all();
        return view('pages.check.create', compact('activities','test_methods'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:10|max:500',
            'sugar_content' => 'required|numeric',
            'activity' => 'required|exists:activity_categories,id',
            'test_method' => 'required|exists:test_method,id',
        ]);

        // mengambil data pengguna yang sedang login
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $data = [
            'user_id' => $user->id,
            'height' => $request->input('weight'),
            'weight' => $request->input('height'),
            'sugar_content' => $request->input('sugar_content'),
            'test_method_id' => $request->input('test_method'),
            'activity_categories_id' => $request->input('activity'),
        ];

        $check = ChecksModel::create($data);

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $personalNeed = $this->calculatePersonalNeed(collect([$check]));

        foreach ($days as $day) {
            $weeklyMealPlan = $this->generateMealPlan($personalNeed);
            $this->saveMealPlanHistory($user->id, $check->id, $day, $weeklyMealPlan[$day]);
        }


        return redirect()->route('check.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $check = ChecksModel::find($id);
        $activities = ActivityModel::all();
        $test_methods = TestMethodModel::all();

        return view('pages.check.update', [
            'check' => $check,
            'activities' => $activities,
            'test_methods' => $test_methods
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'weight' => 'required|numeric|min:10|max:500',
            'height' => 'required|numeric|min:50|max:300',
            'sugar_content' => 'nullable|numeric',
            'activity_categories_id' => 'required|exists:activity_categories,id',
            'test_method_id' => 'required|exists:test_method,id',
        ], [
            'height.required' => 'Tinggi badan harus diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
            'height.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight.required' => 'Berat badan harus diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'weight.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight.max' => 'Berat badan tidak boleh melebihi 500 kg.',
            'activity_categories_id.required' => 'Kategori aktivitas harus dipilih.',
            'activity_categories_id.exists' => 'Kategori aktivitas yang dipilih tidak valid.',
            'test_method_id.required' => 'Metode pengujian harus dipilih.',
            'test_method_id.exists' => 'Metode pengujian yang dipilih tidak valid.',
        ]);

        $check = ChecksModel::find($id);

        $check->height = $request->input('height');
        $check->weight = $request->input('weight');
        $check->sugar_content = $request->input('sugar_content');
        $check->activity_categories_id = $request->input('activity_categories_id');
        $check->test_method_id = $request->input('test_method_id');

        $check->save();

        $userId = Auth::id();
        $personalNeed = $this->calculatePersonalNeed($check);
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($days as $day) {
            $weeklyMealPlan = $this->generateMealPlan($personalNeed);
            $this->saveMealPlanHistory($userId, $check->id,$day, $weeklyMealPlan[$day]);
        }

        return redirect()->route('check.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = ChecksModel::find($id);

        if ($check != null) {
            $check->mealPlanHistories()->delete();

            $check->delete();
        }

        return redirect()->route('check.index');
    }


}
