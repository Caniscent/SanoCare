<?php

namespace App\Http\Controllers\Admin;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\FoodTypeModel;
use App\Models\MealPlanModel;
use App\Models\CleanFoodModel;
use App\Models\FoodGroupModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Article $data)
    {
        $article = $data->count();
        $food = CleanFoodModel::count();
        $group = FoodGroupModel::count();
        $type = FoodTypeModel::count();
        return view('admin.pages.home.index', compact(['article', 'food', 'group', 'type']));
    }
    public function getArticlesByMonth()
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $articles = Article::select(
            DB::raw('MONTHNAME(published_at) as month'),
            DB::raw('COUNT(id) as count'),
            DB::raw('MONTH(published_at) as month_number')
        )
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->groupBy('month', 'month_number')
        ->orderBy('month_number', 'asc')
        ->get();

        $articleCounts = $articles->pluck('count', 'month')->toArray();

        $result = [];
        foreach ($months as $month) {
            $result[] = [
                'month' => $month,
                'count' => $articleCounts[$month] ?? 0,
            ];
        }

        return response()->json($result);
    }
    public function getLogMealBymonth()
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $mealPlans = MealPlanModel::select(
            DB::raw('MONTHNAME(created_at) as month'),
            DB::raw('COUNT(Distinct measurement_id) as count'),
            DB::raw('MONTH(created_at) as month_number')
        )
        ->whereNotNull('created_at')
        ->groupBy('month', 'month_number')
        ->orderBy('month_number', 'asc')
        ->get();

        $logCounts = $mealPlans->pluck('count', 'month')->toArray();

        $result = [];
        foreach ($months as $month) {
            $result[] = [
                'month' => $month,
                'count' => $logCounts[$month] ?? 0,
            ];
        }

        return response()->json($result);
    }
}
