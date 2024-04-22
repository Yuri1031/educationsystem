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
// ⚪︎⚪︎      -> 画面推移詳細

Route::get('/user',
[App\Http\Controllers\UserController::class, 'user'])->name('user');

Route::get('/curriculum_progress', 
[App\Http\Controllers\UserController::class, 'curriculum_progress'])->name('curriculum_progress');

Route::get('/curriculum_show/{id}', 
[App\Http\Controllers\CurriculumController::class, 'curriculum_show'])->name('curriculum.show');

Route::get('/timetable', [App\Http\Controllers\CurriculumController::class, 'timetable'])->name('timetable');

Route::get('/notice_show', [App\Http\Controllers\ArticleController::class, 'notice_show'])->name('notice.show');

Route::get('/password_update_show', [App\Http\Controllers\UserController::class, 'password_update_show'])->name('password.update.show');

Route::get('/profile_update_show', [App\Http\Controllers\UserController::class, 'profile_update_show'])->name('profile.update.show');

Route::post('/password_update', [App\Http\Controllers\UserController::class, 'password_update'])->name('password.update');

Route::post('/profile_update', [App\Http\Controllers\UserController::class, 'profile_update'])->name('profile.update');
