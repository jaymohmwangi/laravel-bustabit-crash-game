<?php

namespace App\Contracts;

use App\Models\Giveaway;
use Illuminate\Support\Collection;

interface GiveaWayRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get the giveaways for a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getGiveawaysByUser(int $userId): Collection;

    /**
     * Get the total amount of giveaways for a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountByUser(int $userId): float;

    /**
     * Create a new giveaway record for a user.
     *
     * @param int $userId
     * @param float $amount
     * @return Giveaway
     */
    public function createGiveaway(int $userId, float $amount): Giveaway;
}
