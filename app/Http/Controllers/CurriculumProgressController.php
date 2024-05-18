<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;

class CurriculumProgressController extends Controller
{
    // 授業進捗ページへ推移
    public function curriculum_progress() {
        //テスト用
        $user = User::find(2);
        Auth::login($user);

        // ここから本コード
        $user = Auth::user();
        
        if($user === null){
            return view('userLogin');
        }else {
            $curriculums = Curriculum::all();
            $grades = Grade::all();
    
            $curriculumsByGrade = [];
    
            foreach ($grades as $grade) {
                $curriculumsByGrade[$grade->name] = Curriculum::where('grade_id', $grade->id)->get();
            }
    
            return view('user_curriculum_progress')
            ->with([
                'user' => $user,
                'curriculums' => $curriculums,
                'curriculumsByGrade' => $curriculumsByGrade,
            ]);
        }
    }
}
