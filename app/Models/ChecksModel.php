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

    public function activityCategories()
    {
        return $this->belongsTo(ActivityModel::class, 'activity_categories_id');
    }

    public function testMethod()
    {
        return $this->belongsTo(TestMethodModel::class, 'test_method_id');
    }

    public function mealPlanHistories()
    {
        return $this->hasMany(HistoryModel::class, 'check_id');
    }
}
