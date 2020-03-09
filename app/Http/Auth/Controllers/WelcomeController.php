<?php

namespace App\Http\Auth\Controllers;

use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends BaseWelcomeController
{
    public function sendPasswordSavedResponse(): Response
    {
        flash()->success('Your password has been saved.');

        return redirect()->route('mailcoach.campaigns');
    }
}
