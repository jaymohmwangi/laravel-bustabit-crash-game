<?php

namespace App\Repositories;

use App\Models\Funding;
use App\Contracts\FundingRepositoryContract;
use mysql_xdevapi\Collection;

class EloquentFundingRepository extends EloquentBaseRepository implements FundingRepositoryContract
{
    /**
     * FundingRepository constructor.
     *
     * @param Funding $model
     */
    public function __construct(Funding $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the most recent funding records for a user.
     *
     * @param int $userId
     * @param int $limit
     * @return mixed
     */
    public function getRecentFundingsByUser(int $userId, int $limit = 10)
    {
        return $this->model->where('user_id', $userId)->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * Get the funding records within a specified date range.
     *
     * @param string $fromDate
     * @param string $toDate
     * @return mixed
     */
    public function getFundingsByDateRange(string $fromDate, string $toDate) : coll
    {
        return $this->model->whereBetween('created_at', [$fromDate, $toDate])->get();
    }

    /**
     * Get the total amount of fundings for all users.
     *
     * @return float
     */
    public function getTotalAmountForAllUsers()
    {
        return $this->model->sum('amount');
    }

    /**
     * Get funding records by status.
     *
     * @param string $status
     * @return mixed
     */
    public function getFundingsByStatus(string $status)
    {
        return $this->model->where('status', $status)->get();
    }

    /**
     * Get the total number of fundings for a specified user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalFundingsCountByUser(int $userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }

    // Add more methods as needed
    /**
     * Get all funding records for a user.
     *
     * @param int $userId
     * @return mixed
     */
    public function getFundingsByUser(int $userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * Get the total amount of fundings for a user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountByUser(int $userId)
    {
        return $this->model->where('user_id', $userId)->sum('amount');
    }

    /**
     * Create a new funding record.
     *
     * @param int $userId
     * @param float $amount
     * @param string|null $transactionId
     * @return mixed
     */
    public function createFunding(int $userId, float $amount, string $transactionId = null)
    {
        return $this->model->create([
            'user_id' => $userId,
            'amount' => $amount,
            'bitcoin_deposit_txid' => $transactionId,
        ]);
    }

    /**
     * Update the status of a funding record.
     *
     * @param int $fundingId
     * @param string $status
     * @return mixed
     */
    public function updateFundingStatus(int $fundingId, string $status)
    {
        $funding = $this->model->findOrFail($fundingId);
        $funding->update(['status' => $status]);

        return $funding;
    }

}
