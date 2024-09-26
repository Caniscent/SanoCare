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
            $height = $item->height_check;
            $weight = $item->weight_check;

            // Kalkulasi tubuh ideal
            $idealWeight = ($height - 100) - (($height - 100) * 0.1);

            if ($weight == $idealWeight) {
                // Tubuh ideal, ambil berita untuk mempertahankan tubuh ideal
                $item->status = 'ideal';
                $item->news = NewsModel::where('type', 'ideal')->get();
            } else {
                // Tubuh tidak ideal, ambil berita untuk mencapai tubuh ideal
                $item->status = 'not_ideal';
                $item->news = NewsModel::where('type', 'not_ideal')->get();
            }
        }

        return view('pages.check.index', ['data' => $data]);
    }

    public function manage()
    {
        $data = CheckModel::all();
        return view('pages.check.manage', [
            'data' => $data
        ]);
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
