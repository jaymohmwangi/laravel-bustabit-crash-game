<?php

namespace App\Providers;

use App\Contracts\PlayRepositoryContract;
use App\Contracts\UserRepositoryContract;
use App\Repositories\EloquentPlayRepository;
use App\Services\PlayService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class PlayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PlayRepositoryContract::class,EloquentPlayRepository::class);
        $this->app->singleton(PlayService::class, function ($app) {
            return new PlayService($app->make(PlayRepositoryContract::class));
        });
        $this->app->singleton('playservice', function ($app) {
            return new PlayService($app->make(PlayRepositoryContract::class));
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
