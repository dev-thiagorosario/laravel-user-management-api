<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\Auth\LogoutController;


Route::post('/register', CreateUserController::class)->name('register');
Route::post('/login',[LoginController::class])->name('login');
Route::post('/logout',[LogoutController::class])->name('logout');
