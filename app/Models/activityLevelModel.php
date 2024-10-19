<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLevelModel extends Model
{
    use HasFactory;

    protected $table = 'activity_levels';
    protected $guarded = ['id'];

    public function measurements() {
        return $this->hasMany(MeasurementModel::class,'activity_level_id');
    }
}
