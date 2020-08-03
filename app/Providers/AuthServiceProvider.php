<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Policies\PersonalAccessTokenPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        PersonalAccessToken::class => PersonalAccessTokenPolicy::class

    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
