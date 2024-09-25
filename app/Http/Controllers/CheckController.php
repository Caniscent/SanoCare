<?php

namespace App\Http\Controllers;

use App\Models\CheckModel;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $check = CheckModel::all();
        return view('pages.check.index', [
            'check' => $check
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
        $check = $request->all();
        CheckModel::create($check);

        return redirect()->route('pages.check.index');
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
        //
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

        return redirect()->route('product.manage');
    }
}
