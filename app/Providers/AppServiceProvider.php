<?php

namespace App\Providers;

use App\Http\App\ViewComposers\HealthViewComposer;
use App\Models\User;
use App\Support\EditorConfiguration\EditorConfiguration;
use App\Support\EditorConfiguration\EditorConfigurationDriverRepository;
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
        Gate::define('viewMailcoach', fn(User $user) => true);

        Flash::levels([
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'error',
        ]);

        $this
            ->registerMailConfiguration()
            ->registerTransactionalMailConfiguration()
            ->registerEditorConfiguration();


        View::composer('app.layouts.partials.health', HealthViewComposer::class);
    }

    protected function registerMailConfiguration(): self
    {
        $this->app->bind(MailConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('config-mailcoach-app/mail.json'));

            return new MailConfiguration(
                $valueStore,
                app()->get('config'),
                new MailConfigurationDriverRepository()
            );
        });

        app(MailConfiguration::class)->registerConfigValues();

        return $this;
    }

    protected function registerTransactionalMailConfiguration(): self
    {
        $this->app->bind(TransactionalMailConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('config-mailcoach-app/transactional-mail.json'));

            return new TransactionalMailConfiguration(
                $valueStore,
                app()->get('config'),
                new TransactionalMailConfigurationDriverRepository()
            );
        });

        app(TransactionalMailConfiguration::class)->registerConfigValues();

        return $this;
    }

    protected function registerEditorConfiguration(): self
    {
        $this->app->bind(EditorConfiguration::class, function () {
            $valueStore = Valuestore::make(base_path('config-mailcoach-app/editor.json'));

            return new EditorConfiguration(
                $valueStore,
                app()->get('config'),
                new EditorConfigurationDriverRepository()
            );
        });

        app(EditorConfiguration::class)->registerConfigValues();

        return $this;
    }
}
