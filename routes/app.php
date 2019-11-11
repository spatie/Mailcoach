<?php

use App\Http\App\Controllers\Settings\Account\AccountController;
use App\Http\App\Controllers\Settings\Account\PasswordController;
use App\Http\App\Controllers\Settings\Users\CreateUserController;
use App\Http\App\Controllers\Settings\Users\DestroyUserController;
use App\Http\App\Controllers\Settings\Users\UpdateUserController;
use App\Http\App\Controllers\Settings\Users\UsersIndexController;
use App\Http\Auth\Controllers\LogoutController;

Route::mailcoach('/');

Route::prefix('settings')->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'index']);
        Route::put('/', [AccountController::class, 'update']);

        Route::get('password', [PasswordController::class, 'index']);
        Route::put('password', [PasswordController::class, 'update']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndexController::class)->name('mailcoach-app.users');
        Route::get('create', [CreateUserController::class, 'create']);
        Route::post('/', [CreateUserController::class, 'store']);

        Route::prefix('{user}')->group(function () {
            Route::get('edit', [UpdateUserController::class, 'edit']);
            Route::put('edit', [UpdateUserController::class, 'update']);

            Route::delete('/', DestroyUserController::class);
        });
    });
});

Route::post('logout', LogoutController::class);
