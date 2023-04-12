<?php

namespace App\Services;

use App\Contracts\ChatMessageRepositoryContract;
use App\Models\ChatMessage;
use Illuminate\Support\Collection;

class ChatMessageService
{
    protected $chatMessageRepository;

    public function __construct(ChatMessageRepositoryContract $chatMessageRepository)
    {
        $this->chatMessageRepository = $chatMessageRepository;
    }

    /**
     * Get chat messages by a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getMessagesByUser(int $userId): Collection
    {
        return $this->chatMessageRepository->getMessagesByUser($userId);
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
        return $this->chatMessageRepository->getRecentMessagesByChannel($channel, $limit);
    }

    /**
     * Find a chat message by its primary key.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id): \Illuminate\Database\Eloquent\Model
    {
        return $this->chatMessageRepository->find($id);
    }

    /**
     * Create a new chat message.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->chatMessageRepository->create($data);
    }
    /**
     * Find all chat messages.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->chatMessageRepository->all();
    }

    /**
     * Update a chat message.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->chatMessageRepository->update($id, $data);
    }

    /**
     * Delete a chat message.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->chatMessageRepository->delete($id);
    }
}
