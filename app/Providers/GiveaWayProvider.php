<?php

namespace App\Providers;

use App\Contracts\GiveawayRepositoryContract;
use App\Repositories\EloquentGiveaWayRepository;
use App\Services\GiveawayService;
use Illuminate\Support\ServiceProvider;

class GiveaWayProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GiveawayRepositoryContract::class,EloquentGiveaWayRepository::class);
        $this->app->singleton(GiveaWayService::class, function ($app) {
            return new GiveaWayService($app->make(EloquentGiveaWayRepository::class));
        });
        $this->app->singleton('gameservice', function ($app) {
            return new GiveaWayService($app->make(EloquentGiveaWayRepository::class));
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
