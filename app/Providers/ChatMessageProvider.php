<?php

namespace App\Providers;

use App\Contracts\ChatMessageRepositoryContract;
use App\Repositories\EloquentChatMessageRepository;
use App\Services\ChatMessageService;
use Illuminate\Support\ServiceProvider;

class ChatMessageProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ChatMessageRepositoryContract::class,EloquentChatMessageRepository::class);
        $this->app->singleton(ChatMessageService::class, function ($app) {
            return new ChatMessageService($app->make(ChatMessageRepositoryContract::class));
        });
        $this->app->singleton('chatservice', function ($app) {
            return new ChatMessageService($app->make(ChatMessageRepositoryContract::class));
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
