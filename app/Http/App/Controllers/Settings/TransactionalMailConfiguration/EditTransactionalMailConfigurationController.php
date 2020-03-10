<?php

namespace App\Http\App\Controllers\Settings\TransactionalMailConfiguration;

use App\Http\App\Requests\UpdateMailConfigurationRequest;
use App\Support\MailConfiguration\MailConfiguration;
use App\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;
use Artisan;

class EditTransactionalMailConfigurationController
{
    public function edit(TransactionalMailConfiguration $mailConfiguration)
    {
        return view('app.settings.transactionalMailConfiguration.edit', compact('mailConfiguration'));
    }

    public function update(UpdateMailConfigurationRequest $request, MailConfiguration $mailConfiguration)
    {
        $mailConfiguration->put($request->validated());

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success('The transactional mail configuration was saved.');

        return back();
    }
}
