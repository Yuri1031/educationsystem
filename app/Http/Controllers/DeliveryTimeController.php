<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curriculum;

class DeliveryTimeController extends Controller
{
    public function edit($curriculum_id)
    {
        $curriculum = Curriculum::find($curriculum_id);
        $delivery_times = $curriculum->getDeliveryTimes();
        return view('delivery_times.form', compact('curriculum', 'delivery_times'));
    }

    //配信日時設定画面
    public function showDelivery($id){

            $show_curriculums = new Curriculum();
            $curriculums_id = $show_curriculums -> show($id);
            $curriculums = $show_curriculums -> curriculums();


        return view('delivery_times/delivery_time' , compact('curriculums_id' , 'curriculums'));
    }

    public function preference($request , $id)
    {

    }



    public function delivery_submit(){
        //
    }
}
