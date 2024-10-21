<?php

namespace App\Http\Controllers;

use App\Models\MeasurementModel;
use App\Models\ActivityLevelModel;
use App\Models\TestMethodModel;
use App\Models\MealPlanModel;
use App\Models\MealPlanLogModel;
use App\Services\GeneticAlgorithmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealPlanController extends Controller
{
    protected $geneticAlgorithm;

    public function __construct(GeneticAlgorithmService $geneticAlgorithm)
    {
        $this->middleware('auth');
        $this->geneticAlgorithm = $geneticAlgorithm;
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

        $measurement = MeasurementModel::where('user_id', $userId)
            ->with('user', 'activityLevel', 'testMethod', 'mealPlans')
            ->get();

        if ($measurement->count() === 0) {
            return view('pages.mealPlan.index', ['measurement' => $measurement, 'mealPlans' => null]);
        }

        $this->geneticAlgorithm->checkPrediabetes($measurement);

        $personalNeed = $this->geneticAlgorithm->calculatePersonalNeed($measurement);
        $selectedDay = $request->get('day', now()->locale('id')->format('l'));
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $currentDay = array_search($selectedDay, $days);
        $prevDay = $days[($currentDay - 1 + count($days)) % count($days)];
        $nextDay = $days[($currentDay + 1) % count($days)];

        $mealPlanCount = MeasurementModel::where('user_id', $userId)->with('mealPlans')->count();

        if ($mealPlanCount < 7) {
            $weeklyMealPlan = $this->geneticAlgorithm->generateMealPlan($personalNeed);
            foreach ($days as $day) {
                $this->geneticAlgorithm->saveMealPlanHistory($userId, $measurement->id,$day, $weeklyMealPlan[$day]);
            }
        }

        $mealPlan = MeasurementModel::where('user_id', $userId)->with('MealPlans')
            ->get()
            ->keyBy('day')
            ->map(function ($mealPlans) {
                return json_decode($mealPlans->meal_plans, true);
            });

        return view('pages.mealPlan.index', compact('measurement', 'mealPlans', 'selectedDay', 'prevDay', 'nextDay'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = ActivityLevelModel::all();
        $test_methods = TestMethodModel::all();
        return view('pages.mealPlan.create', compact('activities','test_methods'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:10|max:500',
            'sugar_content' => 'required|numeric|min:50|max:300',
            'activity' => 'required|exists:activity_categories,id',
            'test_method' => 'required|exists:test_method,id',
        ], [
            'height.required' => 'Tinggi badan harus diisi.',
            'height.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight.required' => 'Berat badan harus diisi.',
            'weight.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight.max' => 'Berat badan tidak boleh melebihi 500 kg.',
            'sugar_content.required' => 'Gula darah harus diisi.',
            'sugar_content.min' => 'Gula darah tidak boleh kurang dari 50 mg/dL',
            'sugar_content.max' => 'Gula darah tidak boleh melebihi 300 mg/dL',
            'activity_categories_id.required' => 'Kategori aktivitas harus dipilih.',
            'activity_categories_id.exists' => 'Kategori aktivitas yang dipilih tidak valid.',
            'test_method_id.required' => 'Metode pengujian harus dipilih.',
            'test_method_id.exists' => 'Metode pengujian yang dipilih tidak valid.',
        ]);

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

        $measurement = MeasurementModel::create($data);

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $personalNeed = $this->geneticAlgorithm->calculatePersonalNeed(collect([$measurement]));

        foreach ($days as $day) {
            $weeklyMealPlan = $this->geneticAlgorithm->generateMealPlan($personalNeed);
            $this->geneticAlgorithm->saveMealPlanHistory($user->id, $measurement->id, $day, $weeklyMealPlan[$day]);
        }


        return redirect()->route('meal-plan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $measurement = MeasurementModel::find($id);
        $activities = ActivityLevelModel::all();
        $test_methods = TestMethodModel::all();

        return view('pages.mealPlan.update', [
            'measurement' => $measurement,
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
            'sugar_content' => 'nullable|numeric|min:50|max:300',
            'activity_categories_id' => 'required|exists:activity_categories,id',
            'test_method_id' => 'required|exists:test_method,id',
        ], [
            'height.required' => 'Tinggi badan harus diisi.',
            'height.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight.required' => 'Berat badan harus diisi.',
            'weight.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight.max' => 'Berat badan tidak boleh melebihi 500 kg.',
            'sugar_content.required' => 'Gula darah harus diisi.',
            'sugar_content.min' => 'Gula darah tidak boleh kurang dari 50 mg/dL',
            'sugar_content.max' => 'Gula darah tidak boleh melebihi 300 mg/dL',
            'activity_categories_id.required' => 'Kategori aktivitas harus dipilih.',
            'activity_categories_id.exists' => 'Kategori aktivitas yang dipilih tidak valid.',
            'test_method_id.required' => 'Metode pengujian harus dipilih.',
            'test_method_id.exists' => 'Metode pengujian yang dipilih tidak valid.',
        ]);

        $measurement = MeasurementModel::find($id);

        $measurement->height = $request->input('height');
        $measurement->weight = $request->input('weight');
        $measurement->sugar_content = $request->input('sugar_content');
        $measurement->activity_categories_id = $request->input('activity_categories_id');
        $measurement->test_method_id = $request->input('test_method_id');

        $measurement->save();

        $userId = Auth::id();
        $personalNeed = $this->geneticAlgorithm->calculatePersonalNeed($measurement);
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($days as $day) {
            $weeklyMealPlan = $this->geneticAlgorithm->generateMealPlan($personalNeed);
            $this->geneticAlgorithm->saveMealPlanHistory($userId, $measurement->id,$day, $weeklyMealPlan[$day]);
        }

        return redirect()->route('meal-plan.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $measurement = MeasurementModel::find($id);

        if ($measurement != null) {
            $measurement->mealPlanHistories()->delete();

            $measurement->delete();
        }

        return redirect()->route('meal-plan.index');
    }


}
