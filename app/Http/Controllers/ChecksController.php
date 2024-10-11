<?php

namespace App\Http\Controllers;

use App\Models\ChecksModel;
use App\Models\ActivityModel;
use App\Models\TestMethodModel;
use App\Models\FoodModel;
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
        $userId = Auth::id(); // Get the authenticated user's ID

        if ($userId === null) {
            return redirect()->route('login'); // If not authenticated, redirect to login
        }

        $checks = ChecksModel::where('user_id', $userId)
            ->with('user', 'activityCategories', 'testMethod')
            ->get();

        if ($checks->isEmpty()) {
            return view('pages.check.index', ['check' => $checks, 'mealPlan' => null]);
        }

        // Hitung kebutuhan personal
        $personalNeed = $this->calculatePersonalNeed($checks);

        // Jalankan algoritma genetika untuk menghasilkan meal plan
        $mealPlan = $this->generateMealPlan($personalNeed);

        // Mengambil hari yang dipilih dari query string
        $selectedDay = $request->get('day', now()->locale('id')->format('l')); // Menggunakan locale 'id' untuk bahasa Indonesia


        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $currentDayIndex = array_search($selectedDay, $days);
        $prevDay = $days[($currentDayIndex - 1 + count($days)) % count($days)];
        $nextDay = $days[($currentDayIndex + 1) % count($days)];

        return view('pages.check.index', compact('checks', 'mealPlan', 'selectedDay', 'prevDay', 'nextDay'));
    }


    private function calculatePersonalNeed($checks)
    {
        // Mengambil data user yang dibutuhkan dari checks
        $user = $checks->first()->user;  // Ambil user dari hasil checks (asumsi ada data user)
        $check = $checks->first();  // Ambil salah satu record check untuk menghitung
        $age = $user->age;
        $gender = $user->gender;
        $height = $check->height;  // Tinggi dalam cm
        $weight = $check->weight;  // Berat dalam kg

        // Kategori aktivitas fisik user (diambil dari activity_categories)
        $activityCategory = $check->activityCategories->activity;
        $activityFactor = $this->getActivityFactor($activityCategory);

        // Menghitung BMR (Basal Metabolic Rate) dengan rumus Mifflin-St Jeor
        if ($gender === 'laki-laki') {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;  // Untuk pria
        } else {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;  // Untuk wanita
        }

        // Menghitung TDEE (Total Daily Energy Expenditure) berdasarkan aktivitas fisik
        $tdee = $bmr * $activityFactor;

        // Distribusi Makronutrien
        // Anggaplah distribusi 15% protein, 30% lemak, 55% karbohidrat dari total kalori
        $protein_g = ($tdee * 0.15) / 4;  // 1 gram protein = 4 kalori
        $fat_g = ($tdee * 0.30) / 9;  // 1 gram lemak = 9 kalori
        $carbs_g = ($tdee * 0.55) / 4;  // 1 gram karbohidrat = 4 kalori
        $fiber_g = $this->calculateFiberNeed($age, $gender);  // Serat berdasarkan rekomendasi umum

        // Return hasil kebutuhan personal
        $result = [
            'energy_kal' => $tdee,
            'protein_g' => $protein_g,
            'fat_g' => $fat_g,
            'carbs_g' => $carbs_g,
            'fiber_g' => $fiber_g,
        ];

        return $result;
    }

    // Mengambil faktor aktivitas berdasarkan kategori
    private function getActivityFactor($activityCategory)
    {
        switch ($activityCategory) {
            case 'Sangat Ringan': // Sedentari (minim aktivitas)
                return 1.2;
            case 'Ringan': // Aktivitas ringan
                return 1.375;
            case 'Sedang': // Aktivitas sedang
                return 1.55;
            case 'Berat': // Aktivitas berat
                return 1.725;
            default:
                return 1.2; // Default jika tidak diketahui
        }
    }

    // Menghitung kebutuhan serat berdasarkan usia dan jenis kelamin
    private function calculateFiberNeed($age, $gender)
    {
        if ($gender === 'laki-laki') {
            return $age <= 50 ? 38 : 30; // Pria: 38g serat (<=50), 30g (>50)
        } else {
            return $age <= 50 ? 25 : 21; // Wanita: 25g serat (<=50), 21g (>50)
        }
    }

    private function generateMealPlan($personalNeed)
    {
        $populationSize = 100;
        $generations = 100;
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']; // Array hari dalam bahasa Inggris

        // Initialize population
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $population[] = $this->randomMealPlan();
        }

        // Run the genetic algorithm
        for ($generation = 0; $generation < $generations; $generation++) {
            // Calculate fitness for each meal plan
            $fitness = array_map(function($mealPlan) use ($personalNeed) {
                return $this->calculateFitness($mealPlan, $personalNeed);
            }, $population);

            // Select the best meal plans
            $population = $this->selectBest($population, $fitness);

            // Perform crossover and mutation
            $population = $this->crossoverAndMutate($population);
        }

        // Return meal plans for each day
        $weeklyMealPlan = [];
        foreach ($days as $day) {
            $weeklyMealPlan[$day] = $population[array_rand($population)]; // Ambil secara acak dari populasi terbaik
        }

        return $weeklyMealPlan; // Kembalikan array untuk setiap hari
    }


    private function randomMealPlan()
    {
        return [
            'breakfast' => FoodModel::inRandomOrder()->take(3)->get(),
            'lunch' => FoodModel::inRandomOrder()->take(3)->get(),
            'dinner' => FoodModel::inRandomOrder()->take(3)->get(),
        ];
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

        // Summing the nutrients from all meals
        foreach ($mealPlan as $meal) {
            foreach ($meal as $food) {
                $totalNutrients['energy_kal'] += $food->energy_kal;
                $totalNutrients['protein_g'] += $food->protein_g;
                $totalNutrients['fat_g'] += $food->fat_g;
                $totalNutrients['carbs_g'] += $food->carbs_g;
                $totalNutrients['fiber_g'] += $food->fiber_g;
            }
        }

        // Calculate fitness based on how close the meal plan meets personal needs
        $fitness = 0;
        $fitness += abs($personalNeed['energy_kal'] - $totalNutrients['energy_kal']);
        $fitness += abs($personalNeed['protein_g'] - $totalNutrients['protein_g']);
        $fitness += abs($personalNeed['fat_g'] - $totalNutrients['fat_g']);
        $fitness += abs($personalNeed['carbs_g'] - $totalNutrients['carbs_g']);
        $fitness += abs($personalNeed['fiber_g'] - $totalNutrients['fiber_g']);

        return 1 / ($fitness + 1); // Inverse of the error (lower error -> higher fitness)
    }

    private function selectBest($population, $fitness)
    {
        // Sort population by fitness (higher fitness is better)
        array_multisort($fitness, SORT_DESC, $population);

        // Select the top 50% of the population
        return array_slice($population, 0, count($population) / 2);
    }

    private function crossoverAndMutate($population)
    {
        // Perform crossover and mutation to create new individuals
        $newPopulation = [];

        while (count($newPopulation) < count($population) * 2) {
            // Randomly select two parents from the population
            $parent1 = $population[array_rand($population)];
            $parent2 = $population[array_rand($population)];

            // Crossover: Mix meals between parents
            $child = [
                'breakfast' => rand(0, 1) ? $parent1['breakfast'] : $parent2['breakfast'],
                'lunch' => rand(0, 1) ? $parent1['lunch'] : $parent2['lunch'],
                'dinner' => rand(0, 1) ? $parent1['dinner'] : $parent2['dinner'],
            ];

            // Mutation: Randomly change one meal in the child
            if (rand(0, 100) < 10) { // 10% chance of mutation
                $mealType = ['breakfast', 'lunch', 'dinner'][array_rand(['breakfast', 'lunch', 'dinner'])];
                $child[$mealType] = FoodModel::inRandomOrder()->take(3)->get();
            }

            $newPopulation[] = $child;
        }

        return $newPopulation;
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

        // pastikan pengguna terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        // siapkan data untuk disimpan di tabel checks
        $data = [
            'user_id' => $user->id,
            'height' => $request->input('weight'),
            'weight' => $request->input('height'),
            'sugar_content' => $request->input('sugar_content'),
            'test_method_id' => $request->input('test_method'),
            'activity_categories_id' => $request->input('activity'),
        ];

        ChecksModel::create($data);

        // redirect ke halaman check.index
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

        return redirect()->route('check.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = ChecksModel::find($id);

        if ($check != null) {
            $check->delete();
        }

        return redirect()->route('check.index');
    }
}
