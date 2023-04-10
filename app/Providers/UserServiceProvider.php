<?php

namespace App\Providers;

use App\Contracts\UserRepositoryContract;
use App\Repositories\EloquentUserRepository;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class,EloquentUserRepository::class);
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryContract::class));
        });
        $this->app->singleton('userservice', function ($app) {
            return new UserService($app->make(UserRepositoryContract::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
