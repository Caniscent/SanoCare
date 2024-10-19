<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMethodModel extends Model
{
    use HasFactory;

    protected $table = 'test_methods';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function measurements() {
        return $this->hasMany(MeasurementModel::class,'test_method_id');
    }
}
