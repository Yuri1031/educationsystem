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

Route::get('timetable', [App\Http\Controllers\CurriculumController::class, 'timetable'])->name('timetable');

Route::get('profile.setting', [App\Http\Controllers\UserController::class, 'profile_setting'])->name('profile.setting');
