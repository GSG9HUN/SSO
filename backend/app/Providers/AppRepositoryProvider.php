<?php

namespace App\Providers;

use App\Interfaces\SessionsRepositoryInterface;
use App\Repositories\SessionsRepository;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SessionsRepositoryInterface::class,SessionsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
