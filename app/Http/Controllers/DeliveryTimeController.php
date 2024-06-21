<?php

namespace App\Http\Controllers;

use App\Models\DeliveryTime;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Curriculum;

class DeliveryTimeController extends Controller
{
    // 『配信日時設定画面』を表示
    public function edit($curriculums_id)
    {
        $curriculum = Curriculum::find($curriculums_id);
        $delivery_times = $curriculum->getDeliveryTimes();
        return view('delivery_times.form', compact('curriculum', 'delivery_times'));
    }

    // 配信日時を作成
    public function store(Request $request)
    {
        try {
            $delivery_time = new DeliveryTime();
            $delivery_time->curriculums_id = $request->input('curriculums_id');
            $this->setDeliveryInfo($request, $delivery_time);
            $delivery_time->save();

            return response()->json([
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'stacktrace' => $this->processStacktrace($e->getTraceAsString()),
            ], 500);
        }
    }

    // 配信日時を更新
    public function update(Request $request, $id)
    {
        try {
            $delivery_time = DeliveryTime::findOrFail($id);
            $this->setDeliveryInfo($request, $delivery_time);
            $delivery_time->save();

            return response()->json([
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'stacktrace' => $this->processStacktrace($e->getTraceAsString()),
            ], 500);
        }
    }

    // 配信日時を削除
    public function destroy($id)
    {
        try {
            $delivery_time = DeliveryTime::findOrFail($id);
            $delivery_time->delete();
            return response()->json([
                'status' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'stacktrace' => $this->processStacktrace($e->getTraceAsString()),
            ], 500);
        }
    }

    // リクエストからデータを引き出して、$delivery_timeのdelivery_from、delivery_toをセット
    // store()、update()で同じロジックを利用するので、この関数に処理を集約する
    private function setDeliveryInfo(Request $request, $delivery_time)
    {
        $delivery_time->setDeliveryFrom($request->input('date_from'), $request->input('time_from'));
        $delivery_time->setDeliveryTo($request->input('date_to'), $request->input('time_to'));
    }

    private function processStacktrace(string $stacktrace)
    {
        $ret = str_replace(base_path(), 'educationsystem/', $stacktrace);
        return str_replace(PHP_EOL, '<br>', $ret);
    }
}
