<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curriculum;
use App\Models\Delivery_time;

class Delivery_timeController extends Controller
{
    //配信日時設定画面
    public function showDelivery($id){

            $show_curriculums = new Curriculum();
            $curriculums = $show_curriculums -> show($id);
            
        return view('delivery_times/delivery_time' , compact('curriculums'));
    }

    public function delivery_submit(){
        //
    }
}
