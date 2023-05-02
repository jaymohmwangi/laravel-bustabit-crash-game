<?php

namespace App\Providers;

use App\Contracts\ChatMessageRepositoryContract;
use App\Contracts\UserRepositoryContract;
use App\Repositories\EloquentChatMessageRepository;
use App\Repositories\EloquentUserRepository;
use App\Services\ChatMessageService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ChatMessageServiceProvider extends ServiceProvider
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
        $this->app->singleton('chatmessageservice', function ($app) {
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
