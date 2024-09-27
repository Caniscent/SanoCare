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
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        HabitModel::create($data);

        return redirect()->route('habits.index');
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
    public function edit(HabitModel $habit)
    {
        $this->authorize('update', $habit);
        return view('pages.habits.update', compact('habit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HabitModel $habit)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $habit->update($request->only(['title', 'description', 'status']));
        return redirect()->route('habits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HabitModel $habit)
    {
        $this->authorize('delete', $habit);
        $habit->delete();
        return redirect()->route('habits.index');
    }
}
