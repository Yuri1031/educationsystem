<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Http\Requests\CurriculumsRequest;

class CurriculumController extends Controller
{
    //授業内容編集-画面へ移動
    public function CurriculumEdit(){
        return view('curriculums\curriculums');
    }

    //新規授業設定-画面へ移動
    public function CurriculumCreate(){
        // DB::beginTransaction();
        // try{

        // }
        $model = new Curriculum();
        $grades = $model->getList();

        return view('curriculums_create\curriculums_create', ['grades' => $grades]);
    }

    public function CurriculumStore(CurriculumsRequest $request){
        $grade = Curriculum::where('grade_id' , $request->input('grade_id'))->first();
        $model = new Curriculum();
        $model->storeCurriculum($grade , $request);
        

        return redirect()->route('curriculum_list');
    }
}
