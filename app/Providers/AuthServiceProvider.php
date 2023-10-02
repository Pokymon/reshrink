<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Domain;
use App\Models\Url;
use App\Policies\DomainPolicy;
use App\Policies\UrlPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Url::class => UrlPolicy::class,
        Domain::class => DomainPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
