<?php

namespace Tamas1979\Authority;

use Illuminate\Support\ServiceProvider;

class AuthorityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/authority.php',
            'authority'
        );
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		
        // Config publish
        $this->publishes([
            __DIR__ . '/../config/authority.php' => \base_path('config/authority.php'),
        ], 'config');
    }
}
