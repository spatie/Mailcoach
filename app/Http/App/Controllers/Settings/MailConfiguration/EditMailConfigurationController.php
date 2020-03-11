<?php

namespace App\Http\App\Controllers\Settings\MailConfiguration;

use App\Http\App\Requests\UpdateMailConfigurationRequest;
use App\Support\ConfigCache;
use App\Support\MailConfiguration\MailConfiguration;

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

        ConfigCache::clear();

        flash()->success('The mail configuration was saved.');

        return back();
    }
}
