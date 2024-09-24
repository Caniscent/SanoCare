<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckModel extends Model
{
    use HasFactory;

    protected $table = 'check';
    protected $guarded = ['id'];
}
