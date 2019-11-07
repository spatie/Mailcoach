<?php

namespace App\Providers;

use App\Http\App\Controllers\Campaigns\CampaignsIndexController;
use App\Http\App\Controllers\Campaigns\Draft\CreateCampaignController;
use App\Http\App\Controllers\ConfigurationController;
use App\Http\App\Controllers\EmailLists\CreateEmailListController;
use App\Http\App\Controllers\EmailLists\EmailListsIndexController;
use App\Http\App\Controllers\Settings\Account\AccountController;
use App\Http\App\Controllers\Settings\Account\PasswordController;
use App\Http\App\Controllers\Settings\Users\CreateUserController;
use App\Http\App\Controllers\Settings\Users\UsersIndexController;
use App\Http\App\Controllers\Subscribers\CreateSubscriberController;
use App\Http\App\Controllers\Subscribers\ImportSubscribersController;
use App\Http\App\Controllers\Subscribers\SubscribersIndexController;
use App\Http\App\Controllers\TemplatesController;
use App\Http\App\Resources\UserResource;
use App\Http\Auth\Controllers\ForgotPasswordController;
use App\Http\Auth\Controllers\LoginController;
use App\Http\Auth\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\ViewErrorBag;
use Inertia\Inertia;

class InertiaServiceProvider extends ServiceProvider
{
    public function register()
    {
        Inertia::share([
            'current_user' => function () {
                if (!Auth::check()) {
                    return null;
                }

                return new UserResource(Auth::user());
            },

            'links' => function () {
                return [
                    'login' => action([LoginController::class, 'showLoginForm']),
                    'forgot_password' => action([ForgotPasswordController::class, 'showLinkRequestForm']),
                    'account' => [
                        'index' => action([AccountController::class, 'index']),
                        'password' => action([PasswordController::class, 'index']),
                        'logout' => action(LogoutController::class)
                    ],
                    'users' => [
                        'index' => action(UsersIndexController::class),
                        'create' => action([CreateUserController::class, 'create']),
                    ],
                ];
            },
            'flash' => function () {
                return [
                    'message' => flash()->message ?? '',
                    'type' => flash()->class ?? '',
                ];
            },
            'errors' => function () {
                return Session::get('errors', new ViewErrorBag())->getMessages();
            },
            'request' => function () {
                return [
                    'path' => Request::path(),
                    'query' => [
                        'sort' => Request::query('sort', ''),
                        'page' => Request::query('page', 1),
                        'filter' => Request::query('filter', []),
                    ],
                ];
            },
        ]);

        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }
}
