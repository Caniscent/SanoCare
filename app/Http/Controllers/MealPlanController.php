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

        $measurements = MeasurementModel::where('user_id', $userId)
            ->with('user','mealPlans')
            ->get();

        if ($measurements->isEmpty()) {
            return view('pages.mealPlan.index', ['measurements' => $measurements, 'mealPlans' => null, 'diabetesMessage' => null]);
        }

        $measurement = $measurements->first();
        $diabetesMessage = $this->geneticAlgorithm->checkPrediabetes($measurement);
        $personalNeed = $this->geneticAlgorithm->calculatePersonalNeed($measurement);
        $caloriesNeeded = $personalNeed['calorie'];

        $selectedDay = $request->get('day', now()->locale('id')->format('l'));
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $currentDay = array_search($selectedDay, $days);
        $prevDay = $days[($currentDay - 1 + count($days)) % count($days)];
        $nextDay = $days[($currentDay + 1) % count($days)];

        $mealPlanCount = $measurement->mealPlans()->count();

        if ($mealPlanCount < 7) {
            foreach ($days as $day) {
                $weeklyMealPlan = $this->geneticAlgorithm->generateMealPlan($personalNeed);
                $this->geneticAlgorithm->saveMealPlan($measurement->id,$userId, $day, $weeklyMealPlan[$day]);
                $mealPlanLog = new MealPlanLogModel();
                $mealPlanLog->user_id = $userId;
                $mealPlanLog->day = $day;
                $mealPlanLog->meal_plan = json_encode($weeklyMealPlan[$day]);
                $mealPlanLog->created_at = now();
                $mealPlanLog->updated_at = now();
                $mealPlanLog->save();
           }
        }

        // untuk menampilkan mealplan yang ada
        $mealPlan = MealPlanModel::where('user_id', $userId)
            ->get()
            ->keyBy('day')
            ->map(function ($mealPlans) {
                return json_decode($mealPlans->meal_plan, true);
            });

        return view('pages.mealPlan.index', compact('measurements', 'mealPlan', 'selectedDay', 'prevDay', 'nextDay', 'diabetesMessage', 'caloriesNeeded'));
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
            'sugar_blood' => 'required|numeric|min:50|max:1000',
        ], [
            'height.required' => 'Tinggi badan harus diisi.',
            'height.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight.required' => 'Berat badan harus diisi.',
            'weight.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight.max' => 'Berat badan tidak boleh melebihi 500 kg.',
            'sugar_blood.required' => 'Gula darah harus diisi.',
            'sugar_blood.min' => 'Gula darah tidak boleh kurang dari 50 mg/dL',
            'sugar_blood.max' => 'Gula darah tidak boleh melebihi 1000 mg/dL',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $data = [
            'user_id' => $user->id,
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
            'activity_level_id' => $request->input('level'),
            'sugar_blood' => $request->input('sugar_blood'),
            'test_method_id' => $request->input('test_method'),
        ];

        $measurement = MeasurementModel::create($data);

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $personalNeed = $this->geneticAlgorithm->calculatePersonalNeed(collect([$measurement]));

        foreach ($days as $day) {
            $weeklyMealPlan = $this->geneticAlgorithm->generateMealPlan($personalNeed);
            $this->geneticAlgorithm->saveMealPlan($measurement->id, $user->id, $day, $weeklyMealPlan[$day]);
        }


        return redirect()->route('meal-plan.index')->with('success','Berhasil membuat rencana makan');
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
            'sugar_blood' => 'nullable|numeric|min:50|max:300',
        ], [
            'height.required' => 'Tinggi badan harus diisi.',
            'height.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight.required' => 'Berat badan harus diisi.',
            'weight.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight.max' => 'Berat badan tidak boleh melebihi 500 kg.',
            'sugar_blood.required' => 'Gula darah harus diisi.',
            'sugar_blood.min' => 'Gula darah tidak boleh kurang dari 50 mg/dL',
            'sugar_blood.max' => 'Gula darah tidak boleh melebihi 300 mg/dL',
        ]);

        $measurement = MeasurementModel::find($id);

        $measurement->height = $request->input('height');
        $measurement->weight = $request->input('weight');
        $measurement->activity_level_id = $request->input('level');
        $measurement->sugar_blood = $request->input('sugar_blood');
        $measurement->test_method_id = $request->input('test_method');

        $measurement->save();

        $userId = Auth::id();
        $personalNeed = $this->geneticAlgorithm->calculatePersonalNeed($measurement);
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($days as $day) {
            $weeklyMealPlan = $this->geneticAlgorithm->generateMealPlan($personalNeed);
            $this->geneticAlgorithm->saveMealPlan($measurement->id,$userId,$day,$weeklyMealPlan[$day]);
            $mealPlanLog = new MealPlanLogModel();
            $mealPlanLog->user_id = $userId;
            $mealPlanLog->day = $day;
            $mealPlanLog->meal_plan = json_encode($weeklyMealPlan[$day]);
            $mealPlanLog->created_at = now();
            $mealPlanLog->updated_at = now();
            $mealPlanLog->save();
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
            $measurement->mealPlans()->delete();

            $measurement->delete();
        }

        return redirect()->route('meal-plan.index');
    }


}
