<?php

namespace App\Http\Controllers;

use App\Models\ChecksModel;
use App\Models\NewsModel;
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
        $data = ChecksModel::where('user_id', auth::id())->with('user')->get();

        foreach ($data as $item) {
            $height = $item->height_check / 100;
            $weight = $item->weight_check;

            // Kalkulasi IMT
            $imt = $weight / ($height * $height);
            $item->imt = round($imt,2);

            if($imt < 18.5){
                $item->status = 'Kurus';
                $item->news = NewsModel::where('type', 'not_ideal')->get();
            }elseif($imt >= 18.5 && $imt <= 24.9){
                $item->status = 'Normal';
                $item->news = NewsModel::where('type', 'ideal')->get();
            }elseif($imt >= 25 && $imt <= 29.9){
                $item->status = 'Gemuk';
                $item->news = NewsModel::where('type', 'not_ideal')->get();
            }elseif($imt >= 30 && $imt <= 34.9){
                $item->status = 'Obesitas Level I';
                $item->news = NewsModel::where('type', 'not_ideal')->get();
            }elseif($imt >= 35 && $imt <= 39.9){
                $item->status = 'Obesitas Level II';
                $item->news = NewsModel::where('type', 'not_ideal')->get();
            }elseif($imt >= 40){
                $item->status = 'Obesitas Level III';
                $item->news = NewsModel::where('type', 'not_ideal')->get();
            }
        }


        return view('pages.check.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.check.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    // mengambil data pengguna yang sedang login
    $user = Auth::user();

    // pastikan pengguna terautentikasi
    if (!$user) {
        return redirect()->route('login')->with('error', 'Please login to continue.');
    }

    // siapkan data untuk disimpan di tabel checks
    $data = [
        'user_id' => $user->id,
        'height' => $request->height,
        'weight' => $request->weight,
    ];

    // buat entri baru di tabel checks
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
            'height_check' => 'required|numeric|min:50|max:300',
            'weight_check' => 'required|numeric|min:10|max:500',
        ], [
            'height_check.required' => 'Tinggi badan harus diisi.',
            'height_check.numeric' => 'Tinggi badan harus berupa angka.',
            'height_check.min' => 'Tinggi badan tidak boleh kurang dari 50 cm.',
            'height_check.max' => 'Tinggi badan tidak boleh melebihi 300 cm.',
            'weight_check.required' => 'Berat badan harus diisi.',
            'weight_check.numeric' => 'Berat badan harus berupa angka.',
            'weight_check.min' => 'Berat badan tidak boleh kurang dari 10 kg.',
            'weight_check.max' => 'Berat badan tidak boleh melebihi 500 kg.',
        ]);

        $check = ChecksModel::find($id);

        $check->height_check = $request->input('height_check');
        $check->weight_check = $request->input('weight_check');

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
