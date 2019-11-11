<?php

namespace App\Http\Auth\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class WelcomeController
{
    use ResetsPasswords;

    public function index(Request $request, User $user, string $token = null)
    {
        if (! $user->hasResetToken($token)) {
            flash()->error('The link you clicked is invalid.');

            return redirect()->route('login');
        };

        return view('auth.welcome')->with([
            'token' => $token,
            'email' => $request->email,
            'user' => $user,
        ]);
    }

    public function savePassword(Request $request)
    {
        return $this->reset($request);
    }

    protected function sendResetResponse(string $response): Response
    {
        flash()->success('Welcome! You are now logged in! Your password was saved.');

        return redirect()->route('mailcoach.campaigns');
    }
}
