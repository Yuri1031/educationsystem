<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Delivery_timeController extends Controller
{
    //配信日時設定画面
    public function showDeliveryForm(){
        return view('delivery_times/delivery_time');
    }

    public function delivery_submit(){
        //
    }
}
