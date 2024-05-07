<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// ⚪︎⚪︎.show -> 詳細
// ⚪︎⚪︎      -> 画面推移

Route::get('/user',
[App\Http\Controllers\UserController::class, 'user'])->name('user');

// ★ユーザー画面

// 授業進捗ページへ推移
Route::get('/curriculum_progress', 
[App\Http\Controllers\UserController::class, 'curriculum_progress'])->name('curriculum_progress');

// ユーザー授業進捗ページへ推移
Route::get('/curriculum_show/{id}', 
[App\Http\Controllers\CurriculumController::class, 'curriculum_show'])->name('curriculum.show');

// 時間割ページへ推移
Route::get('/timetable', [App\Http\Controllers\CurriculumController::class, 'timetable'])->name('timetable');

// パスワード変更ページへ推移
Route::get('/password_update_show', [App\Http\Controllers\UserController::class, 'password_update_show'])->name('password.update.show');

// プロフィール設定ページへ推移
Route::get('/profile_update_show', [App\Http\Controllers\UserController::class, 'profile_update_show'])->name('profile.update.show');

// パスワード変更
Route::post('/password_update', [App\Http\Controllers\UserController::class, 'password_update'])->name('password.update');

// プロフィール設定（変更）
Route::post('/profile_update', [App\Http\Controllers\UserController::class, 'profile_update'])->name('profile.update');



// ★管理画面

// 管理TOPページへ推移
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

// お知らせ新規作成ページへ推移
Route::get('article_regist_show', [App\Http\Controllers\ArticleController::class, 'article_regist_show'])->name('article.regist.show');

// お知らせ一覧ページへ推移
Route::get('/notice', [App\Http\Controllers\ArticleController::class, 'notice'])->name('notice');

// お知らせ変更ページへ推移
Route::get('/notice_update_show/{id}', [App\Http\Controllers\ArticleController::class, 'notice_update_show'])->name('notice.update.show');

// お知らせ変更
Route::post('/notice_update/{id}', [App\Http\Controllers\ArticleController::class, 'notice_update'])->name('notice.update');

// お知らせ削除
Route::delete('/notice_delete/{id}', [App\Http\Controllers\ArticleController::class, 'notice_delete'])->name('notice.delete');