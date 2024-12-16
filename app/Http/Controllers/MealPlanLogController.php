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

        $groupedMealPlans = [];
        $currentGroup = [];
        $currentWeekStart = null;

        foreach ($mealPlanLogs as $log) {
            $log->day = $daysID[$log->day] ?? $log->day;

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
        $groupedLogs = collect();

        $currentGroup = [];
        foreach ($mealPlanLogs as $log) {
            if ($log->day == 'Minggu' && count($currentGroup) == 7) {
                $groupedLogs->push($currentGroup);
                $currentGroup = [];
            }
            $currentGroup[] = $log;
        }
        if (count($currentGroup) == 7) {
            $groupedLogs->push($currentGroup);
        }

        if ($groupedLogs->has($groupIndex)) {
            foreach ($groupedLogs[$groupIndex] as $log) {
                $log->delete();
            }
        }

        return redirect()->route('log.index');
    }
}
