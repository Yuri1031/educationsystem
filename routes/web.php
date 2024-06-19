<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeliveryTimeController;
use App\Http\Controllers\CurriculumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ⚪︎⚪︎      -> 画面推移
// ⚪︎⚪︎.show -> 詳細

Route::get('/', function () {
    return redirect()->route('curriculums.list', [ 'id' => 1, ]);
});

Route::prefix('curriculums')->group(function () {
    // 授業一覧画面へルーティング
    Route::get('/list/{id}', [CurriculumController::class, 'index'])->name('curriculums.list');
    Route::get('/list', function () {
        return redirect()->route('curriculums.list', [ 'id' => 1, ]);
    })->name('curriculums.list.default');

    // 授業設定画面へルーティング
    // 授業を新規登録する場合と、授業内容を編集する場合を分ける
    Route::get('/create', [CurriculumController::class, 'create'])->name('curriculums.create');
    Route::get('/edit/{id}', [CurriculumController::class, 'edit'])->name('curriculums.edit');
});

Route::prefix('delivery_times')->group(function () {
    // 配信日時設定画面へルーティング
    Route::get('/edit/{curriculums_id}', [DeliveryTimeController::class, 'edit'])->name('delivery_times.edit');
});
