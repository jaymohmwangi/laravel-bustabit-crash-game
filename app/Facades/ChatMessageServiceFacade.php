<?php

namespace App\Facades;

use App\Services\ChatMessageService;
use Illuminate\Support\Facades\Facade;


/**
 * Class TaskServiceFacade
 *
 * @package App\Facades
 * @method static \App\Models\ChatMessage create(array $attributes)
 * @method static \App\Models\ChatMessage update(array $attributes, \App\Models\ChatMessage $task)
 * @method static \App\Models\ChatMessage|null find(int $id)
 * @method static \Illuminate\Support\Collection all()
 * @method static void delete(\App\Models\ChatMessage $task)
 */
class ChatMessageServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ChatMessageService::class;
    }
}
