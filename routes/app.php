<?php

use App\Http\App\Controllers\Settings\Account\AccountController;
use App\Http\App\Controllers\Settings\Account\PasswordController;
use App\Http\App\Controllers\Settings\Account\TokensController;
use App\Http\App\Controllers\Settings\App\EditAppConfigurationController;
use App\Http\App\Controllers\Settings\EditorController;
use App\Http\App\Controllers\Settings\MailConfiguration\EditMailConfigurationController;
use App\Http\App\Controllers\Settings\MailConfiguration\SendTestMailController;
use App\Http\App\Controllers\Settings\TransactionalMailConfiguration\DeleteTransactionalMailConfiguration;
use App\Http\App\Controllers\Settings\TransactionalMailConfiguration\EditTransactionalMailConfigurationController;
use App\Http\App\Controllers\Settings\TransactionalMailConfiguration\SendTestTransactionalMailController;
use App\Http\App\Controllers\Settings\Users\CreateUserController;
use App\Http\App\Controllers\Settings\Users\DestroyUserController;
use App\Http\App\Controllers\Settings\Users\UpdateUserController;
use App\Http\App\Controllers\Settings\Users\UsersIndexController;
use App\Http\Auth\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

/*TODO: figure out why this is not working */
//Route::mailcoachUnlayer();

Route::prefix('settings')->group(function () {
    Route::get('app-configuration', [EditAppConfigurationController::class, 'edit'])->name('appConfiguration');
    Route::put('app-configuration', [EditAppConfigurationController::class, 'update']);

    Route::prefix('account')->group(function () {
        Route::get('details', [AccountController::class, 'index'])->name('account');
        Route::put('details', [AccountController::class, 'update']);

        Route::get('password', [PasswordController::class, 'index'])->name('password');
        Route::put('password', [PasswordController::class, 'update']);

        Route::get('tokens', [TokensController::class, 'index'])->name('tokens');
        Route::put('tokens', [TokensController::class, 'destroy']);
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

    Route::get('transactional-mail-configuration', [EditTransactionalMailConfigurationController::class, 'edit'])->name('transactionalMailConfiguration');
    Route::put('transactional-mail-configuration', [EditTransactionalMailConfigurationController::class, 'update']);
    Route::delete('transactional-mail-configuration', DeleteTransactionalMailConfiguration::class)->name('deleteTransactionalMailConfiguration');
    Route::get('send-transactional-test-mail', [SendTestTransactionalMailController::class, 'show'])->name('sendTransactionalTestEmail');
    Route::post('send-transactional-test-mail', [SendTestTransactionalMailController::class, 'sendTransactionalTestEmail']);

    Route::get('editor', [EditorController::class, 'edit'])->name('editor');
    Route::post('editor', [EditorController::class, 'update']);
});

Route::post('logout', LogoutController::class)->name('logout');
