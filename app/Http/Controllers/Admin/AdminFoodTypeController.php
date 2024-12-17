<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Exports\TypeExport;
use App\Imports\TypeImport;
use Illuminate\Http\Request;
use App\Models\FoodTypeModel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\FoodTypeRequest;

class AdminFoodTypeController extends Controller
{
    public function index()
    {
        $food = FoodTypeModel::
        select(['id', 'type', 'description', 'status'])
        ->orderBy('type', 'asc')
        ->get();
        return view('admin.pages.foodType.index', compact('food'));
    }
    public function create()
    {
        return view('admin.pages.foodType.form',[
            'foodType' => new FoodTypeModel(),
            'page_meta' => [
            'url' => route('admin.food-type.store'),
                'title' => 'Tambah Tipe',
                // 'desctiption' => 'lorem Ipsum',
                'submit_text' => 'Kirim',
                'method' => 'post',
            ],
        ]);
    }
    public function store(FoodTypeRequest $request)
    {
        $status = $request->input('status') ? true : false;
        $data =[
            'type' => $request->type,
            'description' => $request->description,
            'status' => $status,
        ];
        FoodTypeModel::create($data);

        return redirect()
        ->route('admin.food-type.index')
        ->with('success', 'Data tipe makanan berhasil ditambahkan!');
    }
    public function edit(FoodTypeModel $food_type)
    {
        return view('admin.pages.foodType.form', [
            'food_type' => $food_type,
            'page_meta' => [
                'url' => route('admin.food-type.update', $food_type->id),
                'title' => 'Edit Tipe',
                'sub_title' => 'Edit Data',
                'description' => ' cleanFood details.',
                'submit_text' => 'Simpan',
                'method' => 'put',
            ]
        ]);
    }
    public function update(FoodTypeRequest $request, $id)
    {
        $type = FoodTypeModel::findOrFail($id);
        $status = $request->input('status') ? true : false;
        $data =[
            'type' => $request->type,
            'description' => $request->description,
            'status' => $status,
        ];
        $type->update($data);
        return redirect()
        ->route('admin.food-type.index')
        ->with('success', 'Data Tipe makanan berhasil diedit!');
    }
    public function import(Request $request)
    {
        Excel::import(new TypeImport, $request->file('import'));
        return redirect()
        ->route('admin.food-type.index')
        ->with('success', 'Data tipe makanan berhasil diimport!');
    }
    public function export()
    {
        return Excel::download(new TypeExport, 'FoodType'.Carbon::now()->timestamp.'.xlsx');
        // return (new TypeExport)->download('FoodType'.Carbon::now()->timestamp.'.xlsx');
    }
}
