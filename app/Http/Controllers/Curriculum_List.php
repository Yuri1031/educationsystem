<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Delivery_time;
use Illuminate\Support\Facades\DB;

class Curriculum_List extends Controller
{
    //授業一覧-画面
    public function showCurriculum_List(Request $request)
    {
        $deliverytimes = Delivery_time::all();
        $model = new Curriculum();
        $curriculums = $model->getCurriculum();
        return view('curriculums_list\curriculums_list' , compact('curriculums' , 'deliverytimes'));
    }

    public function checkGrade(Request $request)
    {
        $inputGrade = $request->input('grade');
        $matchingGrades = DB::table('curriculums')->where('grade_id', $inputGrade)->get();

        if($matchingGrades->isNotEmpty()){
            $message = "一致しています";
        }else{
            $message = '一致していません';
        }

        return view('curriculums_list\curriculums_result' , compact('matchingGrades' , 'message'));


    }
}
