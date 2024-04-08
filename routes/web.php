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

//ログイン画面
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//管理用
Route::view('/admin/login', 'admin/login');
Route::post('/admin/login', [App\Http\Controllers\admin\LoginController::class, 'login']);
Route::post('admin/logout', [App\Http\Controllers\admin\LoginController::class,'logout']);
Route::view('/admin/register', 'admin/register');
Route::post('/admin/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);
Route::view('/admin/home', 'admin/home')->middleware('auth:admin');

//パスワードリセット
Route::view('/admin/password/reset', 'admin/passwords/email');
Route::post('/admin/password/email', [App\Http\Controllers\admin\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::view('/admin/password/reset/{token}', [App\Http\Controllers\admin\ResetPasswordController::class,'showResetForm']);
Route::post('/admin/password/reset', [App\Http\Controllers\admin\ResetPasswordController::class, 'reset']);