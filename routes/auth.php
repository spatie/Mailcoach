<?php

use App\Http\Auth\Controllers\ForgotPasswordController;
use App\Http\Auth\Controllers\LoginController;
use App\Http\Auth\Controllers\ResetPasswordController;
use App\Http\Auth\Controllers\WelcomeController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);

Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('welcome/{token}', [WelcomeController::class, 'index'])->name('welcome');
    Route::post('welcome/save-password', [WelcomeController::class, 'savePassword']);
});
