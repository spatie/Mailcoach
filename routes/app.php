<?php

use App\Http\App\Controllers\Settings\Account\AccountController;
use App\Http\App\Controllers\Settings\Account\PasswordController;
use App\Http\App\Controllers\Settings\MailConfiguration\EditMailConfigurationController;
use App\Http\App\Controllers\Settings\MailConfiguration\SendTestMailController;
use App\Http\App\Controllers\Settings\Users\CreateUserController;
use App\Http\App\Controllers\Settings\Users\DestroyUserController;
use App\Http\App\Controllers\Settings\Users\UpdateUserController;
use App\Http\App\Controllers\Settings\Users\UsersIndexController;
use App\Http\Auth\Controllers\LogoutController;

Route::prefix('settings')->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('details', [AccountController::class, 'index'])->name('account');
        Route::put('details', [AccountController::class, 'update']);

        Route::get('password', [PasswordController::class, 'index'])->name('password');
        Route::put('password', [PasswordController::class, 'update']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndexController::class)->name('users');
        Route::post('create', CreateUserController::class)->name('users.create');

        Route::prefix('{user}')->group(function () {
            Route::get('edit', [UpdateUserController::class, 'edit'])->name('users.edit');
            Route::put('edit', [UpdateUserController::class, 'update']);

            Route::delete('/', DestroyUserController::class)->name('users.delete');
        });
    });

    Route::get('mail-configuration', [EditMailConfigurationController::class, 'edit'])->name('mailConfiguration');
    Route::put('mail-configuration', [EditMailConfigurationController::class, 'update']);
    Route::get('send-test-mail', [SendTestMailController::class, 'show'])->name('sendTestMail');
    Route::post('send-test-mail', [SendTestMailController::class, 'sendTestEmail']);

});

Route::post('logout', LogoutController::class)->name('logout');
