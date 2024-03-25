<?php

namespace App\Providers;

use App\Interfaces\SuperAdminInterfaces\InvitationRepositoryInterface;
use App\Services\SuperAdminServices\InvitationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
