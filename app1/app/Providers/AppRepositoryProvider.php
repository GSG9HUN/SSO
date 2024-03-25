<?php

namespace App\Providers;

use App\Interfaces\SuperAdminInterfaces\CategoryRepositoryInterface;
use App\Interfaces\SuperAdminInterfaces\ColorRepositoryInterface;
use App\Interfaces\SuperAdminInterfaces\CountyRepositoryInterface;
use App\Interfaces\SuperAdminInterfaces\InvitationRepositoryInterface;
use App\Interfaces\SuperAdminInterfaces\SettlementRepositoryInterface;
use App\Interfaces\SuperAdminInterfaces\SizeRepositoryInterface;
use App\Interfaces\SuperAdminInterfaces\SpeciesRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorRepository;
use App\Repositories\CountyRepository;
use App\Repositories\InvitationRepository;
use App\Repositories\SettlementRepository;
use App\Repositories\SizeRepository;
use App\Repositories\SpeciesRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(ColorRepositoryInterface::class,ColorRepository::class);
        $this->app->bind(CountyRepositoryInterface::class,CountyRepository::class);
        $this->app->bind(InvitationRepositoryInterface::class,InvitationRepository::class);
        $this->app->bind(SettlementRepositoryInterface::class,SettlementRepository::class);
        $this->app->bind(SizeRepositoryInterface::class,SizeRepository::class);
        $this->app->bind(SpeciesRepositoryInterface::class,SpeciesRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
