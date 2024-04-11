<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends BaseWelcomeController
{
    public function showWelcomeForm(Request $request, User $user)
    {
        return view('auth.welcome')->with([
            'email' => $request->email,
            'user' => $user,
        ]);
    }

    public function sendPasswordSavedResponse(): Response
    {
        notify(__mc('Your password has been saved.'));

        return redirect()->route('mailcoach.dashboard');
    }
}
