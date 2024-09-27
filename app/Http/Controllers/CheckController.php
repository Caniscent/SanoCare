<?php

namespace App\Http\Controllers;

use App\Models\CheckModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CheckModel::all();

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
        $data = $request->all();
        CheckModel::create($data);

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
        $check = CheckModel::find($id);

        return view('pages.check.update', [
            'check' => $check
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $check = CheckModel::find($id);

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
        $check = CheckModel::find($id);

        if ($check != null) {
            $check->delete();
        }

        return redirect()->route('check.index');
    }
}
