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
//トップ画面　お知らせ
Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticlesController::class, 'show'])->name('article.show');

//受講画面
Route::get('/curriculums', [App\Http\Controllers\CurriculumsController::class, 'index'])->name('curriculums');
Route::get('/curriculums/{id}', [App\Http\Controllers\CurriculumsController::class, 'show'])->name('curriculums.show');
//受講画面 「受講しました」ボタン処理
Route::post('/curriculums/enroll', [App\Http\Controllers\CurriculumsController::class, 'enroll']);
