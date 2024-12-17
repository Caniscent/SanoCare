<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Exports\GroupExport;
use App\Imports\GroupImport;
use Illuminate\Http\Request;
use App\Models\FoodGroupModel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\FoodGroupRequest;
use App\Http\Requests\GroupTypeRequest;

class AdminFoodGroupController extends Controller
{
    public function index()
    {
        $food = FoodGroupModel::
        select(['id', 'group', 'description', 'status'])
        ->orderBy('group', 'asc')
        ->get();
        return view('admin.pages.foodGroup.index', compact('food'));
    }
    public function create()
    {
        return view('admin.pages.foodGroup.form',[
            'foodGroup' => new FoodGroupModel(),
            'page_meta' => [
            'url' => route('admin.food-group.store'),
                'title' => 'Tambah Jenis',
                // 'desctiption' => 'lorem Ipsum',
                'submit_text' => 'Kirim',
                'method' => 'post',
            ],
        ]);
    }
    public function store(FoodGroupRequest $request)
    {
        $status = $request->input('status') ? true : false;
        $data =[
            'group' => $request->group,
            'description' => $request->description,
            'status' => $status,
        ];
        FoodGroupModel::create($data);

        return redirect()
        ->route('admin.food-group.index')
        ->with('success', 'Data kelompok makanan berhasil ditambahkan!');
    }
    public function edit(FoodGroupModel $food_group)
    {
        return view('admin.pages.foodGroup.form', [
            'food_group' => $food_group,
            'page_meta' => [
                'url' => route('admin.food-group.update', $food_group->id),
                'title' => 'Edit Jenis',
                'sub_title' => 'Edit Data',
                'description' => ' cleanFood details.',
                'submit_text' => 'Simpan',
                'method' => 'put',
            ]
        ]);
    }
    public function update(FoodGroupRequest $request, $id)
    {
        $group = FoodGroupModel::findOrFail($id);
        $status = $request->input('status') ? true : false;
        $data =[
            'group' => $request->group,
            'description' => $request->description,
            'status' => $status,
        ];
        $group->update($data);
        return redirect()
        ->route('admin.food-group.index')
        ->with('success', 'Data kelompok makanan berhasil diedit!');
    }
    public function import(Request $request)
    {
        Excel::import(new GroupImport, $request->file('import'));
        return redirect()
        ->route('admin.food-group.index')
        ->with('success', 'Data jenis makanan berhasil diimport!');
    }
    public function export()
    {
        return Excel::download(new GroupExport, 'FoodGroup'.Carbon::now()->timestamp.'.xlsx');
    }
}
