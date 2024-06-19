<?php

namespace App\Http\Controllers;


use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curriculum;

class DeliveryTimeController extends Controller
{
    public function edit($curriculums_id)
    {
        $curriculum = Curriculum::find($curriculums_id);
        $delivery_times = $curriculum->getDeliveryTimes();
        return view('delivery_times.form', compact('curriculum', 'delivery_times'));
    }

    public function store(Request $request)
    {
        $delivery_time = new DeliveryTime();
        $delivery_time->curriculums_id = $request->input('curriculums_id');
        $this->setDeliveryInfo($request, $delivery_time);
        $delivery_time->save();

        return response()->json([
            'c_id' => $delivery_time->curriculums_id,
            'status' => 'success',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $delivery_time = DeliveryTime::findOrFail($id);
        $this->setDeliveryInfo($request, $delivery_time);
        $delivery_time->save();

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function destroy($id)
    {
        $delivery_time = DeliveryTime::findOrFail($id);
        $delivery_time->delete();
        return response()->json([
            'status' => 'success',
        ], 200);
    }

    private function setDeliveryInfo(Request $request, $delivery_time)
    {
        $delivery_time->setDeliveryFrom($request->input('date_from'), $request->input('time_from'));
        $delivery_time->setDeliveryTo($request->input('date_to'), $request->input('time_to'));
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
