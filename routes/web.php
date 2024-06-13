<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Delivery_timeController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\Curriculum_List;


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
    return view('welcome');
});

//戻るボタン 管理のトップページへ遷移(作業外のためいったん保留)
Route::get('/user',[App\Http\Controllers\UserController::class, 'user'])->name('user');


//　管理画面

//授業一覧ページへ戻る
Route::get('/curriculum_list',[Curriculum_List::class, 'showCurriculum_List'])->name('curriculum_list');

Route::post('/check-grade', [Curriculum_List::class, 'checkGrade'])->name('checkGrade');


//***************************************************************** */

//配信日時設定ページへ遷移
Route::get('/delivery_time/{id}/show',[Delivery_timeController::class, 'showDelivery'])->name('delivery_show');

//配信日時設定のバリエーションへ
Route::post('/delivery_submit',[Delivery_timeController::class, 'delivery_submit'])->name('delivery.submit');

//配信日時設定ページから送信
Route::put('/delivery_time/{id}/preference', [Delivery_timeController::class, 'preference'])->name('time_preference');


//*************************************************************** */


//授業編集ページへ遷移
Route::get('/curriculum_edit',[CurriculumController::class, 'CurriculumEdit'])->name('curriculum_edit');



//******************************************************************** */


//新規授業設定ページへ遷移
Route::get('/curriculum',[CurriculumController::class, 'CurriculumCreate'])->name('curriculum_create');
//新規授業設定ページから送信
Route::post('/curriculum_store',[CurriculumController::class, 'CurriculumStore'])->name('curriculum_store');
