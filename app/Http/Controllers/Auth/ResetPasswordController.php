<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ResetPasswordController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ResetsPasswords;
    use ValidatesRequests;

    public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset', [
            'token' => $request->get('token'),
            'email' => $request->get('email'),
        ]);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        notify(trans($response));

        return redirect()->route(config('mailcoach.redirect_home'));
    }
}
