<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTypeModel extends Model
{
    use HasFactory;

    protected $table = 'food_types';
    protected $guarded = ['id'];
    public $timestamps = false;
    public function foodTypes() {
        return $this->hasMany(FoodTypeModel::class,'food_type_id');
    }
}
