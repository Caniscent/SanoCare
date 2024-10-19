<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanModel extends Model
{
    use HasFactory;

    protected $table = 'meal_plans';
    protected $guarded = ['id'];
    public $timestamps = true;


    public function mealPlanLogs() {
        return $this->hasMany(MealPlanLogModel::class,'meal_plan_id');
    }
}
