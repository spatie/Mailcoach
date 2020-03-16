<?php

namespace App\Http\App\Controllers\Settings\App;

use App\Http\App\Requests\UpdateAppConfigurationRequest;
use App\Support\AppConfiguration\AppConfiguration;
use App\Support\ConfigCache;
use Illuminate\Support\Facades\Artisan;

class EditAppConfigurationController
{
    public function edit(AppConfiguration $appConfiguration)
    {
        return view('app.settings.appConfiguration.edit', compact('appConfiguration'));
    }

    public function update(UpdateAppConfigurationRequest $request, AppConfiguration $appConfiguration)
    {
        $appConfiguration->put($request->validated());

        ConfigCache::clear();

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success('The app configuration was saved.');

        return back();
    }
}
