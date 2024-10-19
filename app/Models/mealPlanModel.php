<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mealPlanModel extends Model
{
    use HasFactory;

    protected $table = 'meal_plans';
    protected $guarded = ['id'];
}
