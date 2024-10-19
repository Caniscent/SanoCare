<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanLogModel extends Model
{
    use HasFactory;

    protected $table = 'meal_plan_logs';
    protected $guarded = ['id'];
    public $timestamps = true;


    public function mealPlan() {
        return $this->belongsTo(MealPlanModel::class,'meal_plan_id');
    }
}
