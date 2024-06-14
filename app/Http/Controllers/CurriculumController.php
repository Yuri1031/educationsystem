<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Requests\CurriculumsRequest;

class CurriculumController extends Controller
{
    // 授業一覧を表示
    public function index()
    {
        return view('curriculums.index');
    }

    //授業内容編集-画面へ移動
    public function CurriculumEdit(){
        return view('curriculums\curriculums');
    }

    //新規授業設定-画面へ移動
    public function CurriculumCreate()
    {
        $create_curriculum = new Curriculum();

        $grades = $create_curriculum->getList();
        $curriculums = $create_curriculum->curriculums();

        return view('curriculums_create\curriculums_create', compact('grades' , 'curriculums'));
    }

    public function CurriculumStore(CurriculumsRequest $request)
    {
        $grade = Curriculum::where('grade_id' , $request->input('grade_id'))->first();
        $model = new Curriculum();
        $model->storeCurriculum($grade , $request);

        return redirect()->route('curriculum_list');
    }
}
