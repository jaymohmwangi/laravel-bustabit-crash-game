<?php

namespace App\Services;

use App\Contracts\GiveawayRepositoryContract;
use App\Models\Giveaway;
use Illuminate\Support\Collection;

class GiveawayService
{
    protected $giveawayRepository;

    public function __construct(GiveawayRepositoryContract $giveawayRepository)
    {
        $this->giveawayRepository = $giveawayRepository;
    }

    /**
     * Get the giveaways for a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getGiveawaysByUser(int $userId): Collection
    {
        return $this->giveawayRepository->getGiveawaysByUser($userId);
    }

    /**
     * Get the total amount of giveaways for a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountByUser(int $userId): float
    {
        return $this->giveawayRepository->getTotalAmountByUser($userId);
    }

    /**
     * Create a new giveaway record for a user.
     *
     * @param int $userId
     * @param float $amount
     * @return \App\Models\Giveaway
     */
    public function createGiveaway(int $userId, float $amount): Giveaway
    {
        return $this->giveawayRepository->createGiveaway($userId, $amount);
    }
}
