<?php

namespace App\Http\App\Controllers\Settings\MailConfiguration;

use App\Mail\TestMail;
use Exception;
use Illuminate\Http\Request;
use Mail;

class SendTestMailController
{
    public function show()
    {
        return view('app.settings.mailConfiguration.sendTestMail');
    }

    public function sendTestEmail(Request $request)
    {
        $request->validate([
            'email' => 'email',
        ]);
        try {
            Mail::to($request->email)->send(new TestMail());
        } catch (Exception $exception) {
            report($exception);

            flash()->error("Something went wrong with sending the mail: {$exception->getMessage()}");
        }
    }
}
