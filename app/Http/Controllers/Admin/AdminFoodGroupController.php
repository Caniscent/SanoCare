<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodGroupModel;
use Illuminate\Http\Request;

class AdminFoodGroupController extends Controller
{
    public function index()
    {
        $food = FoodGroupModel::
        select(['id', 'group'])
        ->orderBy('group', 'asc')
        ->get();
        return view('admin.pages.foodGroup.index', compact('food'));
    }
}
