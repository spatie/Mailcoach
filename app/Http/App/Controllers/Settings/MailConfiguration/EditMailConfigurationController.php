<?php

namespace App\Http\App\Controllers\Settings\MailConfiguration;

use App\Support\MailConfiguration;
use Illuminate\Http\Request;

class EditMailConfigurationController
{
    public function edit(MailConfiguration $mailConfiguration)
    {
        return view('app.settings.mailConfiguration.edit', compact('mailConfiguration'));
    }

    public function update(Request $request, MailConfiguration $mailConfiguration)
    {
        $mailConfiguration->put($request->all());

        flash()->success('The mail configuration was saved.');

        return back();
    }
}
