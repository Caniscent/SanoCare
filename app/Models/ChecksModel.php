<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecksModel extends Model
{
    use HasFactory;

    protected $table = 'checks';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityCategory()
    {
        return $this->belongsTo(ActivityModel::class, 'activity_category_id');
    }

    public function testMethod()
    {
        return $this->belongsTo(TestMethodModel::class, 'test_method_id');
    }
}
