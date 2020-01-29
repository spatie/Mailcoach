<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map(Router $router)
    {
        Route::mailcoach('/');
        Route::sesFeedback('ses-feedback');
        Route::mailgunFeedback('mailgun-feedback');
        Route::sendgridFeedback('sendgrid-feedback');

        $this
            ->mapWebRoutes($router)
            ->mapAuthRoutes($router)
            ->mapAppRoutes($router)
            ->mapApiRoutes($router);

        if (app()->environment('local')) {
            $this->mapMailRoutes($router);
        }
    }

    protected function mapWebRoutes(Router $router)
    {
        $router
            ->middleware('web')
            ->group(base_path('routes/web.php'));

        return $this;
    }

    protected function mapAuthRoutes(Router $router): self
    {
        $router
            ->middleware(['web', 'guest'])
            ->group(base_path('routes/auth.php'));

        return $this;
    }

    protected function mapAppRoutes(Router $router)
    {
        $router
            ->middleware(['web', 'auth'])
            ->group(base_path('routes/app.php'));

        return $this;
    }

    protected function mapApiRoutes(Router $router)
    {
        $router
            ->prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));

        return $this;
    }

    private function mapMailRoutes(Router $router)
    {
        $router
            ->prefix('mail')
            ->middleware('web')
            ->group(base_path('routes/local/mails.php'));

        return $this;
    }
}
