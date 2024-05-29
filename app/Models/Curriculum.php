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
        'alway_delivery_flg',
        'grade_id',
    ];


    protected $table = 'curriculums';

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function getList() {
        // gradesテーブルからデータを取得
        $grades = DB::table('grades')->get();
        return $grades;
    }
    
    public function storeCurriculum($grade , $request){
        //授業データを保存
        $curriculums = new Curriculum();
        $curriculums->title = $request->input('title');

        //ここにサムネイル画像を入れる
        // 商品画像を保存
        if ($request->hasFile('thumbnail_image')) {
            $imagePath = $request->file('thumbnail_image')->store('images', 'public');
            $curriculums->thumbnail = $imagePath;
        }

        $curriculums->description = $request->input('description');
        $curriculums->video_url = $request->input('video_url');
        $curriculums->alway_delivery_flg = $request->input('alway_delivery_flg');
        $curriculums->grade_id = $request->input('grade_id');

        $curriculums->save();
        return $grade;
    }
}
