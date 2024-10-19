<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleanFoodModel extends Model
{
    use HasFactory;

    protected $table = 'clean_foods';
    protected $guarded = ['id'];
    public $timestamps = true;


    public function foodGroup() {
        return $this->belongsTo(FoodGroupModel::class,'food_group_id');
    }

    public function foodType() {
        return $this->belongsTo(FoodTypeModel::class,'food_type_id');
    }
}

