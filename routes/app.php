<?php

use App\Http\App\Controllers\Campaigns\CampaignsIndexController;
use App\Http\App\Controllers\Campaigns\DestroyCampaignController;
use App\Http\App\Controllers\Campaigns\Draft\CampaignDeliveryController;
use App\Http\App\Controllers\Campaigns\Draft\CampaignHtmlController;
use App\Http\App\Controllers\Campaigns\Draft\CampaignSettingsController;
use App\Http\App\Controllers\Campaigns\Draft\CreateCampaignController;
use App\Http\App\Controllers\Campaigns\Draft\ScheduleCampaignController;
use App\Http\App\Controllers\Campaigns\Draft\SendCampaignController;
use App\Http\App\Controllers\Campaigns\Draft\SendTestEmailController;
use App\Http\App\Controllers\Campaigns\Draft\UnscheduleCampaignController;
use App\Http\App\Controllers\Campaigns\DuplicateCampaignController;
use App\Http\App\Controllers\Campaigns\Sent\CampaignActionsController;
use App\Http\App\Controllers\Campaigns\Sent\CampaignClicksController;
use App\Http\App\Controllers\Campaigns\Sent\CampaignOpensController;
use App\Http\App\Controllers\Campaigns\Sent\CampaignSummaryController;
use App\Http\App\Controllers\Campaigns\Sent\CampaignUnsubscribesController;
use App\Http\App\Controllers\ConfigurationController;
use App\Http\App\Controllers\EmailLists\CreateEmailListController;
use App\Http\App\Controllers\EmailLists\DestroyEmailListController;
use App\Http\App\Controllers\EmailLists\EmailListSettingsController;
use App\Http\App\Controllers\EmailLists\EmailListsIndexController;
use App\Http\App\Controllers\EmailLists\EmailListSubscribersController;
use App\Http\App\Controllers\EmailLists\EmailListSubscriptionFlowController;
use App\Http\App\Controllers\Settings\Account\AccountController;
use App\Http\App\Controllers\Settings\Account\PasswordController;
use App\Http\App\Controllers\Settings\Users\CreateUserController;
use App\Http\App\Controllers\Settings\Users\DestroyUserController;
use App\Http\App\Controllers\Settings\Users\UpdateUserController;
use App\Http\App\Controllers\Settings\Users\UsersIndexController;
use App\Http\App\Controllers\SubscriberImports\DestorySubscriberImportController;
use App\Http\App\Controllers\Subscribers\CreateSubscriberController;
use App\Http\App\Controllers\Subscribers\DestroySubscriberController;
use App\Http\App\Controllers\Subscribers\ImportSubscribersController;
use App\Http\App\Controllers\Subscribers\ReceivedCampaignsController;
use App\Http\App\Controllers\Subscribers\SubscribersIndexController;
use App\Http\App\Controllers\Subscribers\UpdateSubscriberController;
use App\Http\App\Controllers\TemplatesController;
use App\Http\Auth\Controllers\LogoutController;

Route::prefix('settings')->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'index']);
        Route::put('/', [AccountController::class, 'update']);

        Route::get('password', [PasswordController::class, 'index']);
        Route::put('password', [PasswordController::class, 'update']);
    });

    Route::get('configuration', [ConfigurationController::class, 'index']);

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndexController::class);
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
