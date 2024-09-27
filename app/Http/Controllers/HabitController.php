<?php

namespace App\Http\Controllers;

use App\Models\HabitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
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
        $habits = HabitModel::where('user_id', auth::id())->get();
        return view('pages.habits.index', compact('habits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.habits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        HabitModel::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('habits.index')->with('success', 'Kebiasaan berhasil ditambahkan.');
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
    public function edit($id)
    {
        $habit = HabitModel::findOrFail($id);
        return view('pages.habits.update', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $habit = HabitModel::findOrFail($id);
        $habit->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('habits.index')->with('success', 'Kebiasaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $habit = HabitModel::findOrFail($id);
        $habit->delete();

        return redirect()->route('habits.index')->with('success', 'Kebiasaan berhasil dihapus.');
    }
}
