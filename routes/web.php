<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\WelcomeController;
use App\Http\Middleware\WelcomesNewUsers;
use App\Livewire\AccountComponent;
use App\Livewire\EditUserComponent;
use App\Livewire\UsersComponent;
use Illuminate\Support\Facades\Route;
use Spatie\Mailcoach\Http\App\Middleware\BootstrapSettingsNavigation;

Route::middleware('guest')->group(function () {
    Route::redirect('/', '/login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot-password');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('web', WelcomesNewUsers::class)->group(function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');

    Route::middleware(array_merge(config('mailcoach.middleware.web'), [
        BootstrapSettingsNavigation::class,
    ]))->group(function () {
        Route::get('account', AccountComponent::class)->name('account');

        Route::prefix('users')->group(function () {
            Route::get('/', UsersComponent::class)->name('users');
            Route::get('{user}', EditUserComponent::class)->name('users.edit');
        });
    });
});
