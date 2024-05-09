<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $fillable = ['title', 'thumbnail', 'description', 'video_url', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


}
