<?php

namespace App\Http\Auth\Controllers;

use App\Http\App\Controllers\Campaigns\CampaignsIndexController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController
{
    use AuthenticatesUsers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $redirectTo = '/campaigns';

    public function showLoginForm()
    {
        return Inertia::render('auth.Login');
    }

    public function authenticated(Request $request, $user)
    {
        flash()->success('You are now logged in!');

        return redirect()->intended(action(CampaignsIndexController::class));
    }
}
