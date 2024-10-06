<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    use HasFactory;

    protected $table = 'activity_categories';
    protected $guarded = ['id'];

    public function checks()
    {
        return $this->hasMany(ChecksModel::class, 'activity_category_id');
    }
}
