<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\MealPlanLogModel;
use app\Models\MeasurementModel;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
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
        $histories = MeasurementModel::where('user_id', $user->id)->whereNotNull('saved_to_history')->get();

        return view('pages.history.index', ['histories' => $histories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'check_id' => 'required|exists:checks,id',
        ]);

        $check = MeasurementModel::find($request->input('check_id'));

        if ($check) {
            $check->saved_to_history = true; // Misalkan ada kolom untuk menandai bahwa sudah disimpan ke histori
            $check->save();
        }

        return redirect()->route('history.index')->with('success', 'Data berhasil ditambahkan ke histori.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
