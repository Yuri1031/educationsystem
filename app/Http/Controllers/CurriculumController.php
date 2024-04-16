<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    // 授業の詳細ページへ推移
    public function curriculum_show($id) {
        $curriculum = Curriculum::find($id);
        
        return view('// 授業ページのファイル名',[
            'curriculum' => $curriculum,
        ]);
    }

    // 時間割ページへ推移
    public function timetable() {
        //
    }

}
