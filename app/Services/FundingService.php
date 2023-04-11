<?php

namespace App\Services;

use App\Contracts\FundingRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class FundingService
{
    protected $fundingRepositoryContract;

    public function __construct(FundingRepositoryContract $fundingRepositoryContract)
    {
        $this->fundingRepositoryContract = $fundingRepositoryContract;
    }

    /**
     * Get fundings for a specific user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getFundingsByUser(int $userId): Collection
    {
        return $this->fundingRepositoryContract->getFundingsByUser($userId);
    }

    /**
     * Get the total amount of funding by a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountByUser(int $userId): float
    {
        return $this->fundingRepositoryContract->getTotalAmountByUser($userId);
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
        return $this->fundingRepositoryContract->createFunding($userId, $amount, $transactionId);
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
        return $this->fundingRepositoryContract->updateFundingStatus($fundingId, $status);
    }
    /**
     * Get the most recent funding records for a user.
     *
     * @param int $userId
     * @param int $limit
     * @return Collection
     */
    public function getRecentFundingsByUser(int $userId, int $limit = 10): Collection
    {
        return $this->fundingRepositoryContract->getRecentFundingsByUser($userId, $limit);
    }

    /**
     * Get the funding records within a specified date range.
     *
     * @param string $fromDate
     * @param string $toDate
     * @return Collection
     */
    public function getFundingsByDateRange(string $fromDate, string $toDate): Collection
    {
        return $this->fundingRepositoryContract->getFundingsByDateRange($fromDate, $toDate);
    }

    /**
     * Get the total amount of fundings for all users.
     *
     * @return float
     */
    public function getTotalAmountForAllUsers(): float
    {
        return $this->fundingRepositoryContract->getTotalAmountForAllUsers();
    }

    /**
     * Get funding records by status.
     *
     * @param string $status
     * @return Collection
     */
    public function getFundingsByStatus(string $status): Collection
    {
        return $this->fundingRepositoryContract->getFundingsByStatus($status);
    }

    /**
     * Get the total number of fundings for a specified user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalFundingsCountByUser(int $userId): int
    {
        return $this->fundingRepositoryContract->getTotalFundingsCountByUser($userId);
    }
}

