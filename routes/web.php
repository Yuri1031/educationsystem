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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ⚪︎⚪︎.show -> 詳細
// ⚪︎⚪︎      -> 画面推移

Route::get('/user',
[App\Http\Controllers\UserController::class, 'user'])->name('user');

// ★ユーザー画面

//ログインページへ推移
Route::get('/user/login', [App\Http\controllers\UserController::class, 'user_login'])->name('user.login');

// 授業進捗ページへ推移
Route::get('/user/curriculum_progress', 
[App\Http\Controllers\CurriculumProgressController::class, 'curriculum_progress'])->name('curriculum_progress');

// ユーザー授業進捗ページへ推移
Route::get('/user/curriculum_show/{id}', 
[App\Http\Controllers\CurriculumController::class, 'curriculum_show'])->name('curriculum.show');

// 時間割ページへ推移
Route::get('/user/timetable', [App\Http\Controllers\CurriculumController::class, 'timetable'])->name('timetable');

// パスワード変更ページへ推移
Route::get('/user/password_update_show', [App\Http\Controllers\UserController::class, 'password_update_show'])->name('password.update.show');

// プロフィール設定ページへ推移
Route::get('/user/profile_update_show', [App\Http\Controllers\UserController::class, 'profile_update_show'])->name('profile.update.show');

// お知らせページへ推移
Route::get('/user/notice/{id}', [App\Http\controllers\ArticleController::class, 'user_notice'])->name('user.notice');

// -----機能------

// パスワード変更
Route::post('/user/password_update', [App\Http\Controllers\UserController::class, 'password_update'])->name('password.update');

// プロフィール設定（変更）
Route::post('/user/profile_update', [App\Http\Controllers\UserController::class, 'profile_update'])->name('profile.update');



// ★管理画面

// 管理ログインページへ推移
Route::get('/admin/login', [App\Http\controllers\AdminController::class, 'admin_login'])->name('admin.login');

// 管理TOPページへ推移
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

//授業管理ページへ推移
Route::get('/admin/curriculum_management', [App\Http\controllers\CurriculumController::class, 'curriculum_management'])->name('curriculum.management');

// お知らせ新規作成ページへ推移
Route::get('admin/article_regist_show', [App\Http\Controllers\ArticleController::class, 'article_regist_show'])->name('article.regist.show');

// お知らせ一覧ページへ推移
Route::get('/admin/notice', [App\Http\Controllers\ArticleController::class, 'notice'])->name('admin.notice');

// お知らせ変更ページへ推移
Route::get('/admin/notice_update_show/{id}', [App\Http\Controllers\ArticleController::class, 'notice_update_show'])->name('admin.notice.update.show');

// バナー管理ページへ推移
Route::get('/admin/banner_management', [App\Http\controllers\BannerController::class, 'banner_management'])->name('banner.management');

// -----機能------

// お知らせ新規登録
Route::post('/admin/notice_regist', [App\Http\Controllers\ArticleController::class, 'notice_regist'])->name('admin.notice.regist');

// お知らせ変更
Route::post('/admin/notice_update/{id}', [App\Http\Controllers\ArticleController::class, 'notice_update'])->name('admin.notice.update');

// お知らせ削除
Route::delete('/admin/notice_delete/{id}', [App\Http\Controllers\ArticleController::class, 'notice_delete'])->name('notice.delete');