<?php

namespace App\Repositories;

use App\Contracts\GiveawayRepositoryContract;
use App\Models\Giveaway;
use Illuminate\Support\Collection;

class EloquentGiveaWayRepository extends EloquentBaseRepository implements GiveaWayRepositoryContract
{
    public function __construct(Giveaway $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the giveaways for a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getGiveawaysByUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * Get the total amount of giveaways for a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountByUser(int $userId): float
    {
        return $this->model->where('user_id', $userId)->sum('amount');
    }

    /**
     * Create a new giveaway record for a user.
     *
     * @param int $userId
     * @param float $amount
     * @return Giveaway
     */
    public function createGiveaway(int $userId, float $amount): Giveaway
    {
        return $this->model->create([
            'user_id' => $userId,
            'amount' => $amount,
        ]);
    }
}
