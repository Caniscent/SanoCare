<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodGroupModel extends Model
{
    use HasFactory;

    protected $table = 'food_groups';
    protected $guarded = ['id'];

    public function cleanFoods() {
        return $this->hasMany(CleanFoodModel::class,'food_group_id');
    }
}
