<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryTimeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('curriculums')->group(function () {
    Route::post('/', [CurriculumController::class, 'store'])->name('curriculums.store');
    Route::put('/{id}', [CurriculumController::class, 'update'])->name('curriculums.update');
});

Route::prefix('delivery_times')->group(function () {
    Route::post('/', [DeliveryTimeController::class, 'store'])->name('delivery_times.store');
    Route::put('/{id}', [DeliveryTimeController::class, 'update'])->name('delivery_times.update');
    Route::delete('/{id}', [DeliveryTimeController::class, 'destroy'])->name('delivery_times.destroy');
});
