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

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
