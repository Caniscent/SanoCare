<?php

namespace App\Http\Controllers;

use App\Models\MealPlanLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealPlanLogController extends Controller{
    public function index(Request $request)
    {
        $mealPlanLogs = MealPlanLogModel::all();

        $daysID = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $mealTypesID = [
            'breakfast' => 'Sarapan',
            'lunch' => 'Makan Siang',
            'dinner' => 'Makan Malam'
        ];

        foreach ($mealPlanLogs as $log) {
            $log->day = $daysID[$log->day] ?? $log->day;
            $mealPlan = json_decode($log->meal_plan, true);

            foreach ($mealPlan as $mealType => $mealItems) {
                if (array_key_exists($mealType, $mealTypesID)) {
                    $mealPlan[$mealTypesID[$mealType]] = $mealItems;
                    unset($mealPlan[$mealType]);
                }
            }

            $log->meal_plan = json_encode($mealPlan);
        }

        return view('pages.log.index', compact('mealPlanLogs'));
    }
}
