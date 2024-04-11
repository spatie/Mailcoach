<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ForgotPasswordController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use SendsPasswordResetEmails;
    use ValidatesRequests;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        notify(trans($response));

        return redirect()->back();
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        notifyError(trans($response));

        return redirect()->back();
    }
}
