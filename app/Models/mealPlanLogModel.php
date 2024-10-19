<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mealPlanLogModel extends Model
{
    use HasFactory;

    protected $table = 'meal_plan_logs';
    protected $guarded = [''];
}
