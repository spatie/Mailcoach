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
            'from_email' => 'email',
            'to_email' => 'email',
        ]);
        try {
            Mail::to($request->to_email)->sendNow(new TestMail($request->from_email, $request->to_email));

            flash()->success("A test mail has been sent to {$request->to_email}. Please check if it arrived.");
        } catch (Exception $exception) {
            report($exception);

            flash()->error("Something went wrong with sending the mail: {$exception->getMessage()}");
        }

        return redirect()->back();
    }
}
