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
}
