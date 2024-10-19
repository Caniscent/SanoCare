<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementModel extends Model
{
    use HasFactory;

    protected $table = 'measurements';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function activityLevel() {
        return $this->belongsTo(ActivityLevelModel::class,'activity_level_id');
    }

    public function testMethod() {
        return $this->belongsTo(TestMethodModel::class,'test_method_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
