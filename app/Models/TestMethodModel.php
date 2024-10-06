<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMethodModel extends Model
{
    use HasFactory;

    protected $table = 'test_method';
    protected $guarded = ['id'];

    public function checks()
    {
        return $this->hasMany(ChecksModel::class, 'test_method_id');
    }
}
