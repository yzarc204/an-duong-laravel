<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/register', [AuthController::class, 'register'])->name('register');
Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('login');
