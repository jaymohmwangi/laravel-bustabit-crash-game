<?php

namespace App\Repositories;

use App\Contracts\ChatMessageRepositoryContract;
use App\Models\ChatMessage;
use Illuminate\Support\Collection;

class EloquentChatMessageRepository extends EloquentBaseRepository implements ChatMessageRepositoryContract
{
    public function __construct(ChatMessage $model)
    {
        parent::__construct($model);
    }

    /**
     * Get chat messages by a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getMessagesByUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * Get recent chat messages in a specific channel.
     *
     * @param string $channel
     * @param int $limit
     * @return Collection
     */
    public function getRecentMessagesByChannel(string $channel, int $limit = 10): Collection
    {
        return $this->model->where('channel', $channel)->orderBy('created_at', 'desc')->limit($limit)->get();
    }


}
