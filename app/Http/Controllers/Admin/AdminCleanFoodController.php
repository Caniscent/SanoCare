<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CleanFoodRequest;
use App\Models\CleanFoodModel;
use App\Models\FoodGroupModel;
use App\Models\FoodTypeModel;
use Illuminate\Http\Request;

class AdminCleanFoodController extends Controller
{
    public function index()
    {
        $food = CleanFoodModel::
        select(['id', 'food_name', 'food_group_id', 'food_type_id'])
        ->with(['foodGroup', 'foodType'])
        ->orderBy('food_name', 'asc')
        ->get();
        return view('admin.pages.cleanFood.index', compact('food'));
    }
    public function create()
    {
        $foodGroups = FoodGroupModel::all();
        $foodTypes = FoodTypeModel::all();
        return view('admin.pages.cleanFood.form',[
            'cleanFood' => new CleanFoodModel(),
            'foodGroups' => $foodGroups,
            'foodTypes' => $foodTypes,
            'page_meta' => [
                'url' => route('admin.clean-food.store'),
                'title' => 'Tambah Makanan',
                // 'desctiption' => 'lorem Ipsum',
                'submit_text' => 'Kirim',
                'method' => 'post',
            ],
        ]);
    }
    public function store(CleanFoodRequest $request)
    {
        $data = $request->validated();

        CleanFoodModel::create($data);
    
        return redirect()
        ->route('admin.clean-food.index')
        ->with('success', 'Data makanan berhasil ditambahkan!');
    }
    public function edit(CleanFoodModel $clean_food)
    {
        $foodGroups = FoodGroupModel::all();
        $foodTypes = FoodTypeModel::all();
        return view('admin.pages.cleanFood.form', [
            'clean_food' => $clean_food,
            'foodGroups' => $foodGroups,
            'foodTypes' => $foodTypes,
            'page_meta' => [
                'url' => route('admin.clean-food.update', $clean_food->id),
                'title' => 'Edit Makanan',
                'sub_title' => 'Edit Data',
                'description' => ' cleanFood details.',
                'submit_text' => 'Simpan',
                'method' => 'put', 
            ]
        ]);
    }
    public function update(CleanFoodRequest $request, $id)
    {
    $food = CleanFoodModel::findOrFail($id);
    $validatedData = $request->validated();
    $food->update($validatedData);
    return redirect()
        ->route('admin.clean-food.index')
        ->with('success', 'Data makanan berhasil diperbarui.');
    }
    public function show(CleanFoodModel $clean_food)
    {
        $foodGroups = FoodGroupModel::all();
        $foodTypes = FoodTypeModel::all();
        return view('admin.pages.cleanFood.show', [
            'clean_food' => $clean_food,
            'foodGroups' => $foodGroups,
            'foodTypes' => $foodTypes,
            'page_meta' => [
                'url' => route('admin.clean-food.show', $clean_food->id),
                'title' => 'Detail Makanan',
                'sub_title' => 'Detail Data',
                'description' => ' cleanFood details.',
            ]
        ]);
    }
}
