<?php

namespace App\Http\Auth\Controllers;

use App\Http\App\Controllers\Campaigns\CampaignsIndexController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ResetPasswordController
{
    use ResetsPasswords, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showResetForm(Request $request, $token = null)
    {
        view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        flash()->success(trans($response));

        return action([CampaignsIndexController::class, 'index']);
    }
}
