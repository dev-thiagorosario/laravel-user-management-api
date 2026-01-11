<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SendEmailConfirmationController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\UpdateUserController;


Route::post('/register', CreateUserController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth:sanctum');

Route::post('/email/confirmation', SendEmailConfirmationController::class)->name('send-email-confirmation')->middleware('auth:sanctum');

Route::get('/confirm-email', ConfirmEmailController::class)->name('confirm-email')->middleware('signed');

Route::post('/change-password', ChangePasswordController::class)->name('change-password')->middleware('auth:sanctum');
Route::post('/reset-password', ResetPasswordController::class)->name('reset-password')->middleware('auth:sanctum');

Route::get('/list-users', ListUserController::class)->name('list-users')->middleware('auth:sanctum');
Route::put('/update-user', UpdateUserController::class)->name('update-user')->middleware('auth:sanctum');
