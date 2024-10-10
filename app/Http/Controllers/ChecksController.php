<?php

namespace App\Http\Controllers;

use App\Models\ChecksModel;
use App\Models\ActivityModel;
use App\Models\TestMethodModel;
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
    public function index()
    {
        $user = Auth::user();
        // $personalData = ChecksModel::where('user_id',$user->id)->with(['activityCategories','testMethod'])->latest()->first();
        $personalData = ChecksModel::where('user_id',$user->id)->with(['activityCategories','testMethod'])->find(7);

        if ($personalData) {
                $this->calculatePersonalNeed(
                $personalData->weight,
                $personalData->height,
                $user->age,
                $user->gender,
                $personalData->sugar_content,
                $personalData->testMethod->method,
                $personalData->activityCategories->activity,
            );
        }

        $dataUser = ChecksModel::where('user_id', auth::id())->with('user')->get();
        return view('pages.check.index', ['data' => $dataUser]);
    }

    public function calculatePersonalNeed($weight, $height, $age, $gender ,$bloodSugar, $testMethod, $activity) {
        $prediabetes = false;

        if ($testMethod == 'Puasa') {
            if ($bloodSugar >= 100 && $bloodSugar <= 125) {
                $prediabetes = true;
            }
            else if ($bloodSugar > 125) {
                return [
                    "error" => True,
                    "code" => "DIABETES",
                ];
            }
        }
        else if ($testMethod == 'TTGO') {
            if ($bloodSugar >= 140 && $bloodSugar <= 199) {
                $prediabetes = true;
            }
            else if ($bloodSugar > 199) {
                return [
                    "error" => True,
                    "code" => "DIABETES",
                ];
            }
        }
        else {
            return [
                "error" => True,
                "code" => "INVALID_BLOOD_SUGAR_TEST",
            ];
        }

        if (!$prediabetes) {
            return [
                "error" => True,
                "code" => "NOT_PRE_DIABETES",
            ];
        }

        // Calculate BMI
        $body_level = [
            "underweight" => 18.5,
            "normal" => 24.9,
            "overweight" => 29.9,
            "obese" => 30,
        ];

        // Perhitungan BMI
        $bmi = round($weight / (($height / 100) ** 2), 2);

        $body = [];

        foreach ($body_level as $category => $threshold ) {
            if ($bmi < $threshold) {
                $body = [$bmi,$category];
            }
            break;
        }

        if (empty($body)){
            $body = [$bmi,'obese'];
        }


        // Calculate Daily Categories
        $cons = ($gender == 'perempuan') ? -161 : 5;
        $daily_calories = (10 * $weight) + (6.25 * $height) - (5 * $age) + $cons;

        $activity_level = [
            "Sangat Ringan" => 1.2,
            "Ringan" => 1.375,
            "Sedang" => 1.55,
            "Berat" => 1.725,
        ];

        $daily_calories += $activity_level[$activity];

        $required_carb = round($daily_calories * 0.5  / 4, 2);
        $required_prot = round($daily_calories * 0.2  / 4, 2);
        $required_fat  = round($daily_calories * 0.2  / 9, 2);
        $required_fibr = round($daily_calories * 0.05 / 1, 2);

        $result = [
            "error" => False,
            "bmi" => $body[0],
            "bodyLevel" => $body[1],
            "dailyCal" => $daily_calories,
            "reqCarb" => $required_carb,
            "reqProt" => $required_prot,
            "reqFat" => $required_fat,
            "reqFibr" => $required_fibr,
        ];
        return $result;
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

        return view('pages.check.update', [
            'check' => $check
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:10|max:500',
        ], [
            'height.required' => 'Tinggi badan harus diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
            'height.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight.required' => 'Berat badan harus diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'weight.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight.max' => 'Berat badan tidak boleh melebihi 500 kg.',
        ]);

        $check = ChecksModel::find($id);

        $check->weight = $request->input('weight');
        $check->height = $request->input('height');
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
