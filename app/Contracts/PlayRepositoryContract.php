<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface PlayRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get the total bet amount by user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalBetAmountByUser(int $userId): int;

    /**
     * Get the top players by total bet amount.
     *
     * @param int $limit
     * @return Collection
     */
    public function getTopPlayersByTotalBetAmount(int $limit = 10): Collection;

    /**
     * Get user plays.
     *
     * @param int $userId
     * @param int $limit
     * @return Collection
     */
    public function getUserPlays(int $userId, int $limit = 10): Collection;

    /**
     * Get recent plays for a game.
     *
     * @param int $gameId
     * @param int $limit
     * @return Collection
     */
    public function getRecentPlaysForGame(int $gameId, int $limit = 10): Collection;

    /**
     * Get user profit.
     *
     * @param int $userId
     * @return int
     */
    public function getUserProfit(int $userId): int;
}
