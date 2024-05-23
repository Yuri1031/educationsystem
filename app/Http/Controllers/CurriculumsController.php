<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculums;
use App\Models\Grades;
use Illuminate\Support\Facades\Auth;

class CurriculumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curriculums = Curriculums::all(); // 全て取得    
        $grades = Grades::all();
        return view('curriculums', compact('curriculums'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();// 認証済みユーザーを取得
        $curriculum = Curriculums::where('user_id', $user->id)->where('id', $id)->firstOrFail();// ユーザーに基づいてカリキュラムを取得
        \Log::info($curriculum);// デバッグ用にログ出力
        return view('curriculums', compact('curriculum')); // ビューにデータを渡す
    }

    public function enroll(Request $request)
    {
        // ユーザーの授業をクリア登録する処理
        $curriculum = Curriculum::findOrFail($request->courseId);
        $curriculum->enrolled = true;
        $curriculum->save();

        // 成功時のレスポンスを返す
        return response()->json(['message' => 'Enrolled successfully'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

