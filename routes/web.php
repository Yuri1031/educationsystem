<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\BannerController;

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

// ログイン画面
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 管理者用ルート
Route::prefix('admin')->name('admin.')->group(function () {
    // ゲスト状態
    Route::middleware('guest:admin')->group(function () {
        Route::view('/login', 'admin/login')->name('login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::view('/register', 'admin/register')->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
    });

    // ログイン済みでのみアクセス可能
    Route::middleware('auth:admin')->group(function () {
        Route::view('/top', 'admin/top')->name('top');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::resource('banners', 'BannerController');
        Route::put('admin/banners/{id}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('admin/banner/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');

        // Route::get('/class_list', [BannerController::class, 'index'])->name('class_list');
        // Route::post('/upload', [BannerController::class, 'store'])->name('banners.store');
    
        // パスワードリセット
        Route::view('/admin/password/reset', 'admin/passwords/email');
        Route::post('/admin/password/email', [App\Http\Controllers\admin\ForgotPasswordController::class, 'sendResetLinkEmail']);
        Route::view('/admin/password/reset/{token}', [App\Http\Controllers\admin\ResetPasswordController::class,'showResetForm']);
        Route::post('/admin/password/reset', [App\Http\Controllers\admin\ResetPasswordController::class, 'reset']);
    });
});

// バナー
Route::get('/admin/class_list', [BannerController::class, 'index'])->name('admin.class_list');
Route::post('/admin/upload', [BannerController::class, 'store'])->name('banners.store');