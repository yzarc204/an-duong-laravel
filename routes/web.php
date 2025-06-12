<?php

use App\Classes\MyAI;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GlucoseRecordController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::match(['GET', 'POST'], '/register', [AuthController::class, 'register'])->name('register');
    Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'glucose-record', 'as' => 'record.'], function () {
        Route::get('/', [GlucoseRecordController::class, 'index'])->name('index');
        Route::get('/create', [GlucoseRecordController::class, 'create'])->name('create');
        Route::post('/store', [GlucoseRecordController::class, 'store'])->name('store');
    });

    Route::get('/meal-suggestion', [SuggestionController::class, 'meal'])->name('meal-suggestion');
    Route::get('/exercise-suggestion', [SuggestionController::class, 'exercise'])->name('exercise-suggestion');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
