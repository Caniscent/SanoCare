<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testMethodModel extends Model
{
    use HasFactory;

    protected $table = 'test_methods';
    protected $guarded = ['id'];
}
