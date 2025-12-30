<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\NewUserConfirmationMailController;
use App\Http\Controllers\SendEmailConfirmationController;


Route::post('/register', CreateUserController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');

Route::post('/email/confirmation', SendEmailConfirmationController::class)->name('send-email-confirmation')->middleware('auth:sanctum');

Route::get('/confirm-email', function () {
    return response()->json(['message' => 'ok'], 200);
})->name('confirm-email')->middleware('signed');

