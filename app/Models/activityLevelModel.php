<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activityLevelModel extends Model
{
    use HasFactory;

    protected $table = 'activity_levels';
    protected $guarded = ['id'];
}
