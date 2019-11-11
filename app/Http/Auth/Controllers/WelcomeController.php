<?php

namespace App\Http\Auth\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class WelcomeController
{
    use ResetsPasswords;

    public function index(Request $request, string $token = null)
    {
        if (!$user = User::findByToken($token)) {
            flash()->error('The link you clicked is invalid.');

            return redirect()->action(LoginController::class);
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
        flash()->info('Welcome! You are now logged in! Your password was saved.');

        return redirect()->route('mailcoach.campaigns');
    }
}
