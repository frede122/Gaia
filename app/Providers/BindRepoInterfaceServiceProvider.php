<?php

namespace App\Providers;

use App\Contracts\Repository\Address\CityRepositoryInterface;
use App\Contracts\Repository\Address\StateRepositoryInterface;
use App\Contracts\Repository\Person\UserRepositoryInterface;
use App\Repositories\Address\CityRepository;
use App\Repositories\Address\StateRepository;
use App\Repositories\Person\UserRepository;
use Illuminate\Support\ServiceProvider;

class BindRepoInterfaceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
    }
}
