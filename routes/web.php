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

//トップ画面
Route::get('/top', [App\Http\Controllers\TopController::class, 'index'])->name('top');
Route::get('/top.banners', [App\Http\Controllers\TopController::class, 'bannersindex'])->name('top.banners');

//受講画面
Route::get('/curriculums/{id}', [CurriculumController::class, 'show'])->name('curriculums.show');
