<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculums;
use App\Models\DeliveryTimes;
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
        $curriculums = Curriculums::with('delivery_times')->get(); // カリキュラムテーブルの全てを取得    
        $user = Auth::user();
        
        foreach ($curriculums as $curriculum) {
            $curriculum->is_in_delivery_period = $this->isInDeliveryPeriod($curriculum);
            $curriculum->enrolled = $this->isEnrolled($curriculum, $user);
        }        
        
        return view('curriculums', compact('curriculums'));

    }



    private function isInDeliveryPeriod($curriculum)
    {
        if ($curriculum->always_delivery_flg) {
            return true;
        }

        $deliveryTimes = $curriculum->delivery_times;

        if ($curriculum->delivery_flg && $deliveryTimes) {
            $now = now();
            return $now->between($deliveryTimes->delivery_from, $deliveryTimes->delivery_to);
        }

        return false;
    }




    private function isEnrolled($curriculum, $user)
    {
        // 例: enrolledカラムがbooleanである場合
        return $curriculum->enrolled;
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
        $curriculum = Curriculums::with('delivery_times')->findOrFail($id);
        $curriculum->is_in_delivery_period = $this->isInDeliveryPeriod($curriculum);
        $curriculum->enrolled = $this->isEnrolled($curriculum, Auth::user());

        \Log::info($curriculum); // デバッグ用にログ出力
        $curriculums = collect([$curriculum]);
        return view('curriculums', compact('curriculums')); // ビューにデータを渡す

    }


    public function enroll(Request $request)
    {
        // ユーザーの授業をクリア登録する処理
        $curriculum = Curriculums::findOrFail($request->courseId);
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

