<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Curriculum_List extends Controller
{
    //授業一覧-画面
    public function showCurriculum_List(){
        return view('curriculums_list\curriculums_list');
    }
}
