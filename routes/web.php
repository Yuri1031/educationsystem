<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\BannerController;

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

//ログイン画面
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//管理用
Route::view('/admin/login', 'admin/login')->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\admin\LoginController::class, 'logout'])->name('admin.logout');
Route::view('/admin/register', 'admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register'])->name('admin.register');
Route::view('/admin/top', 'admin/top')->middleware('auth:admin');
Route::get('/admin/top', [TopController::class, 'show'])->name('admin.top');

//バナー
Route::get('/admin/class_list', [BannerController::class, 'index'])->name('admin.class_list');

//パスワードリセット
Route::view('/admin/password/reset', 'admin/passwords/email');
Route::post('/admin/password/email', [App\Http\Controllers\admin\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::view('/admin/password/reset/{token}', [App\Http\Controllers\admin\ResetPasswordController::class,'showResetForm']);
Route::post('/admin/password/reset', [App\Http\Controllers\admin\ResetPasswordController::class, 'reset']);