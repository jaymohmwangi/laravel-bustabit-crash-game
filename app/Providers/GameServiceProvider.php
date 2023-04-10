<?php

namespace App\Providers;

use App\Contracts\GameRepositoryContract;
use App\Repositories\EloquentGameRepository;
use App\Services\GameService;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GameRepositoryContract::class,EloquentGameRepository::class);
        $this->app->singleton(GameService::class, function ($app) {
            return new GameService($app->make(GameRepositoryContract::class));
        });
        $this->app->singleton('gameservice', function ($app) {
            return new GameService($app->make(GameRepositoryContract::class));
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
