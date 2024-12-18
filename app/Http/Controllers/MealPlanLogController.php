<?php

namespace App\Http\Controllers;

use App\Models\MealPlanLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealPlanLogController extends Controller{
    public function index(Request $request)
    {
        $mealPlanLogs = MealPlanLogModel::orderBy('created_at')->get();

        $daysID = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        $mealTypeID = ['breakfast' => 'sarapan', 'lunch' => 'makan siang', 'dinner' => 'makan malam'];

        $mealOrder = array_keys($mealTypeID);
        $groupedMealPlans = [];
        $currentGroup = [];
        $currentWeekStart = null;

        foreach ($mealPlanLogs as $log) {
            $log->day = $daysID[$log->day] ?? $log->day;

            $mealPlan = json_decode($log->meal_plan, true);
            $sortedMealPlan = array_merge(
                array_flip($mealOrder),
                array_intersect_key($mealPlan, array_flip($mealOrder))
            );
            foreach ($sortedMealPlan as $mealType => $items) {
                $translatedMealType = $mealTypeID[$mealType] ?? $mealType;
                $sortedMealPlan[$translatedMealType] = $sortedMealPlan[$mealType];
                unset($sortedMealPlan[$mealType]);
            }
            $log->meal_plan = json_encode($sortedMealPlan);

            if ($log->day == 'Minggu') {
                if ($currentGroup && count($currentGroup) == 7) {
                    $groupedMealPlans[] = $currentGroup;
                }
                $currentGroup = [$log];
                $currentWeekStart = $log->created_at->format('d-m-Y');
            } else {
                $currentGroup[] = $log;
            }
        }

        if (count($currentGroup) == 7) {
            $groupedMealPlans[] = $currentGroup;
        }

        return view('pages.log.index', compact('groupedMealPlans'));
    }

    public function destroy($groupIndex)
    {
        $mealPlanLogs = MealPlanLogModel::orderBy('created_at')->get();

        $groupedMealPlans = [];
        $currentGroup = [];

        foreach ($mealPlanLogs as $log) {
            if ($log->day == 'Sunday') {
                if ($currentGroup && count($currentGroup) == 7) {
                    $groupedMealPlans[] = $currentGroup;
                }
                $currentGroup = [$log];
            } else {
                $currentGroup[] = $log;
            }
        }

        if (count($currentGroup) == 7) {
            $groupedMealPlans[] = $currentGroup;
        }

        if (!isset($groupedMealPlans[$groupIndex])) {
            return redirect()->back()->withErrors('Kelompok log meal plan tidak ditemukan.');
        }

        foreach ($groupedMealPlans[$groupIndex] as $log) {
            MealPlanLogModel::where('id', $log->id)->delete();
        }

        return redirect()->route('log.index')->with('success', 'Log meal plan berhasil dihapus.');
    }

}
