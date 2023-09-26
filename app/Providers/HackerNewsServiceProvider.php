<?php

namespace App\Providers;

use App\Interfaces\IHackerNewsService;
use App\Services\External\HackerNewsService;
use Illuminate\Support\ServiceProvider;

class HackerNewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(IHackerNewsService::class, HackerNewsService::class);
    }
}
