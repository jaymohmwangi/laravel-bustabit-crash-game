<?php

namespace App\Contracts;

use App\Models\ChatMessage;
use Illuminate\Support\Collection;

interface ChatMessageRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get chat messages by a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getMessagesByUser(int $userId): Collection;

    /**
     * Get recent chat messages in a specific channel.
     *
     * @param string $channel
     * @param int $limit
     * @return Collection
     */
    public function getRecentMessagesByChannel(string $channel, int $limit = 10): Collection;

}
