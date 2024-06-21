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

    // ある学年の全ての授業を取得する
    public static function findByGradeId($id)
    {
        return self::where('grade_id', $id)->get();
    }

    // この授業の全ての配信日時を取得する
    public function getDeliveryTimesAscByDeliveryFrom($asc = true)
    {
        return DeliveryTime::findByCurriculumId($this->id, true);
    }

    // この授業のサムネイル画像のURLを取得する
    public function getThumbnailUrl()
    {
        return asset('storage/uploads/' . $this->id . '/' . $this->thumbnail);
    }
}
