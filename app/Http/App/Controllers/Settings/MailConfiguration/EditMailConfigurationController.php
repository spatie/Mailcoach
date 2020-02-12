<?php

namespace App\Http\App\Controllers\Settings\MailConfiguration;

use App\Http\App\Requests\UpdateMailConfigurationRequest;
use App\Support\MailConfiguration\MailConfiguration;
use Artisan;

class EditMailConfigurationController
{
    public function edit(MailConfiguration $mailConfiguration)
    {
        return view('app.settings.mailConfiguration.edit', compact('mailConfiguration'));
    }

    public function update(UpdateMailConfigurationRequest $request, MailConfiguration $mailConfiguration)
    {
        $mailConfiguration->put($request->validated());

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success('The mail configuration was saved.');

        return back();
    }
}
