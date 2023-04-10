<?php

namespace App\Repositories;

use App\Contracts\PlayRepositoryContract;
use App\Models\Play;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection; // Added missing import

class EloquentPlayRepository extends EloquentBaseRepository implements PlayRepositoryContract
{
    /**
     * EloquentPlayRepository constructor.
     *
     * @param Play $model The Play model instance
     */
    public function __construct(Play $model)
    {
        parent::__construct($model); // Call parent constructor
    }

    /**
     * Get the total bet amount for a user.
     *
     * @param int $userId The ID of the user
     *
     * @return int The total bet amount
     */
    public function getTotalBetAmountByUser(int $userId): int
    {
        return $this->model->where('user_id', $userId)->sum('bet');
    }

    /**
     * Get the top players by total bet amount.
     *
     * @param int $limit The number of players to return (default: 10)
     *
     * @return Collection A collection of users and their total bet amount
     */
    public function getTopPlayersByTotalBetAmount(int $limit = 10): Collection
    {
        return $this->model
            ->selectRaw('user_id, SUM(bet) as total_bet_amount')
            ->groupBy('user_id')
            ->orderBy('total_bet_amount', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get a user's plays.
     *
     * @param int $userId The ID of the user
     * @param int $limit The number of plays to return (default: 10)
     *
     * @return Collection A collection of plays
     */
    public function getUserPlays(int $userId, int $limit = 10): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Get the most recent plays for a game.
     *
     * @param int $gameId The ID of the game
     * @param int $limit The number of plays to return (default: 10)
     *
     * @return Collection A collection of plays
     */
    public function getRecentPlaysForGame(int $gameId, int $limit = 10): Collection
    {
        return $this->model
            ->where('game_id', $gameId)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Get a user's profit.
     *
     * @param int $userId The ID of the user
     *
     * @return int The user's profit
     */
    public function getUserProfit(int $userId): int
    {
        return $this->model
            ->where('user_id', $userId)
            ->sum('cash_out');
    }
}
