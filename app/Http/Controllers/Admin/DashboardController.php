<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CleanFoodModel;
use App\Models\FoodGroupModel;
use App\Models\FoodTypeModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $article = Article::where('status', 'published')->count();
        $food = CleanFoodModel::count();
        $group = FoodGroupModel::count();
        $type = FoodTypeModel::count();
        return view('admin.pages.home.index', compact(['article', 'food', 'group', 'type']));
    }
}
