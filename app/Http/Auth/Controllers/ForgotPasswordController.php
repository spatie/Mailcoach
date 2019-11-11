<?php

namespace App\Http\Auth\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ForgotPasswordController
{
    use SendsPasswordResetEmails, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        flash()->success(trans($response));

        return back();
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        flash()->error(trans($response));

        return back();
    }
}
