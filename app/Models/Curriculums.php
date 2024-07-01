<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryTimes;

class Curriculums extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $fillable = ['title', 'thumbnail', 'description', 'video_url', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function delivery_times()
    {
        return $this->hasOne(DeliveryTimes::class, 'curriculum_id');
    }


}

