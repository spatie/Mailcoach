<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\Subscriber;
use App\Models\SubscriberImport;
use App\Models\Subscription;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map(Router $router)
    {
        $this
            ->mapWebRoutes($router)
            ->mapAuthRoutes($router)
            ->mapAppRoutes($router)
            ->mapApiRoutes($router);
    }

    private function mapAuthRoutes(Router $router): self
    {
        $router
            ->middleware(['web', 'guest'])
            ->group(base_path('routes/auth.php'));

        return $this;
    }

    protected function mapWebRoutes(Router $router)
    {
        $router
            ->middleware('web')
            ->group(base_path('routes/web.php'));

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
}
