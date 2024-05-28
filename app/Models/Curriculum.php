<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'thumbnail', 'description', 'video_url', 'alway_delivery_flg', 'grade_id'];
    protected $table = 'curriculums';

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public function scopeFilterByGradeAndMonth($query, $gradeId, $year, $month)
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        if ($gradeId) {
            $query->where('grade_id', $gradeId);
        }

        return $query->whereHas('deliveryTimes', function ($query) use ($startOfMonth, $endOfMonth) {
            $query->where('alway_delivery_flg', 1)
                ->where('delivery_from', '<=', $endOfMonth)
                ->where('delivery_to', '>=', $startOfMonth)
                ->orWhere('alway_delivery_flg', 0);
        })->with('deliveryTimes');
    }
}
