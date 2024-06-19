<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Grade;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'always_delivery_flg',
        'grade_id',
    ];


    protected $table = 'curriculums';

    // 以下は岡崎の編集箇所
    public static function findByGradeId($id)
    {
        return self::where('grade_id', $id)->get();
    }

    public function getDeliveryTimes()
    {
        return DeliveryTime::findByCurriculumId($this->id);
    }

    public function getThumbnailUrl()
    {
        return asset('storage/uploads/' . $this->id . '/' . $this->thumbnail);
    }
}
