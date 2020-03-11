<?php

namespace App\Http\App\Controllers\Settings\MailConfiguration;

use App\Mail\TransactionalTestMail;
use App\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;
use Exception;
use Illuminate\Http\Request;
use Mail;

class SendTestTransactionalMailController
{
    public function show(TransactionalMailConfiguration $mailConfiguration)
    {
        return view(
            'app.settings.transactionalMailConfiguration.sendTestMail',
            compact('mailConfiguration')
        );
    }

    public function sendTransactionalTestEmail(Request $request)
    {
        $request->validate([
            'from_email' => 'email',
            'to_email' => 'email',
        ]);
        try {
            Mail::mailer('mailcoach-transactional')->to($request->to_email)->sendNow((new TransactionalTestMail($request->from_email, $request->to_email)));

            flash()->success("A test mail has been sent to {$request->to_email}. Please check if it arrived.");
        } catch (Exception $exception) {
            report($exception);

            flash()->error("Something went wrong with sending the mail: {$exception->getMessage()}");
        }

        return redirect()->back();
    }
}
