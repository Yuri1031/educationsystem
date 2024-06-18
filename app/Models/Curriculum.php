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

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function getList()
    {
        // gradesテーブルからデータを取得
        $grades = DB::table('grades')->get();
        return $grades;
    }

    public function curriculums()
    {
        //Curriculumモデルのすべてのレコードを取得して、それを返す
        $query = Self::query();
        $curriculums = $query->get();
        return $curriculums;
    }

    public function getCurriculum()
    {
        $query = Self::query();
        $curriculums = $query->get();
        return $curriculums;
    }
    public function show($id)
    {
        $curriculums = Self::findOrFail($id);
        return $curriculums;
    }



    public function storeCurriculum($grade , $request)
    {
        //授業データを保存
        $curriculums = new Curriculum();
        $curriculums->title = $request->input('title');
        var_dump('thumbnail_image');
        //ここにサムネイル画像を入れる
        // 商品画像を保存
        if ($request->hasFile('thumbnail_image')) {

            return back()->with('error', 'ファイルがアップロードされていません');
            $imagePath = $request->file('thumbnail_image')->store('images', 'public');
            $curriculums->thumbnail = $imagePath;
        }

        $curriculums->description = $request->input('description');
        $curriculums->video_url = $request->input('video_url');
        $curriculums->alway_delivery_flg = $request->boolean('alway_delivery_flg');
        $curriculums->grade_id = $request->input('grade_id');

        $curriculums->save();
        return $curriculums;
    }


    // 以下は岡崎の編集箇所
    /**
     *
     */
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
