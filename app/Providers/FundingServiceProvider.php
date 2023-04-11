<?php

namespace App\Providers;

use App\Contracts\FundingRepositoryContract;
use App\Repositories\EloquentFundingRepository;
use App\Services\FundingService;
use Illuminate\Support\ServiceProvider;

class FundingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FundingRepositoryContract::class,EloquentFundingRepository::class);
        $this->app->singleton(FundingService::class, function ($app) {
            return new FundingService($app->make(FundingRepositoryContract::class));
        });
        $this->app->singleton('gameservice', function ($app) {
            return new FundingService($app->make(FundingRepositoryContract::class));
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
