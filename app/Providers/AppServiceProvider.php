<?php

namespace App\Providers;

use App\Models\User;
use App\Support\MailConfiguration\MailConfiguration;
use App\Support\MailConfiguration\MailConfigurationDriverRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;
use Spatie\Valuestore\Valuestore;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('viewMailcoach', function (User $user) {
            return true;
        });

        Flash::levels([
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'error',
        ]);

        $this->app->bind(MailConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('mailConfiguration.json'));

            return new MailConfiguration(
                $valueStore,
                app()->get('config'),
                new MailConfigurationDriverRepository()
            );
        });

        app(MailConfiguration::class)->registerConfigValues();
    }
}
