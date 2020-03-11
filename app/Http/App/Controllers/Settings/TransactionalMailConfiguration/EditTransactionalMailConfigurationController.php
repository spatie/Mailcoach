<?php

namespace App\Http\App\Controllers\Settings\TransactionalMailConfiguration;

use App\Http\App\Requests\UpdateTransactionalMailConfigurationRequest;
use App\Support\ConfigCache;
use App\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;

class EditTransactionalMailConfigurationController
{
    public function edit(TransactionalMailConfiguration $mailConfiguration)
    {
        return view('app.settings.transactionalMailConfiguration.edit', compact('mailConfiguration'));
    }

    public function update(
        UpdateTransactionalMailConfigurationRequest $request,
        TransactionalMailConfiguration $mailConfiguration
    ) {
        $mailConfiguration->put($request->validated());

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success('The transactional mail configuration was saved.');

        ConfigCache::clear();

        return back();
    }
}
