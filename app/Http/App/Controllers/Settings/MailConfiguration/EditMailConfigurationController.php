<?php

namespace App\Http\App\Controllers\Settings\MailConfiguration;

use App\Support\ConfigCache;
use Illuminate\Support\Facades\Artisan;
use App\Support\MailConfiguration\MailConfiguration;
use App\Http\App\Requests\UpdateMailConfigurationRequest;

class EditMailConfigurationController
{
    public function edit(MailConfiguration $mailConfiguration)
    {
        return view('app.settings.mailConfiguration.edit', compact('mailConfiguration'));
    }

    public function update(UpdateMailConfigurationRequest $request, MailConfiguration $mailConfiguration)
    {
        $mailConfiguration->put($request->validated());

        ConfigCache::clear();

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success(__('The mail configuration was saved.'));

        return back();
    }
}
