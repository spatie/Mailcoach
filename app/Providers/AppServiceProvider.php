<?php

namespace App\Providers;

use App\Http\App\ViewComposers\HealthViewComposer;
use App\Models\User;
use App\Support\MailConfiguration\MailConfiguration;
use App\Support\MailConfiguration\MailConfigurationDriverRepository;
use App\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;
use App\Support\TransactionalMailConfiguration\TransactionalMailConfigurationDriverRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;
use Spatie\Valuestore\Valuestore;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('viewMailcoach', fn (User $user) => true);

        Flash::levels([
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'error',
        ]);

        $this->app->bind(MailConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('config-mailcoach-app/mailConfiguration.json'));

            return new MailConfiguration(
                $valueStore,
                app()->get('config'),
                new MailConfigurationDriverRepository()
            );
        });

        app(MailConfiguration::class)->registerConfigValues();

        $this->app->bind(TransactionalMailConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('config-mailcoach-app/transactionalMailConfiguration.json'));

            return new TransactionalMailConfiguration(
                $valueStore,
                app()->get('config'),
                new TransactionalMailConfigurationDriverRepository()
            );
        });

        app(TransactionalMailConfiguration::class)->registerConfigValues();

        View::composer('app.layouts.partials.health', HealthViewComposer::class);
    }
}
