<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cleanFoodModel extends Model
{
    use HasFactory;

    protected $table = 'clean_foods';
    protected $guarded = ['id'];
}
