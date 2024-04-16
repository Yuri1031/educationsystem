<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // 授業進捗ページへ推移
    public function curriculum_progress() {
        // ログインしているユーザーの情報を取得するように変更
        $user = User::find(1);

        $curriculums = Curriculum::all();
        $grades = Grade::all();

        $curriculumsByGrade = [];

        foreach ($grades as $grade) {
            $curriculumsByGrade[$grade->name] = Curriculum::where('grade_id', $grade->id)->get();
        }

        return view('curriculum_progress')
        ->with([
            'user' => $user,
            'curriculums' => $curriculums,
            'curriculumsByGrade' => $curriculumsByGrade,
        ]);
    }

    // ユーザー画面へ推移
    public function user_show() {
        //
    }

    // プロフィール設定ページへ推移
    public function profile_setting() {
        //
    }
    
}
