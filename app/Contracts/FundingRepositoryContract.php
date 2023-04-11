<?php
namespace App\Contracts;

interface FundingRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get all fundings for the specified user.
     *
     * @param int $userId
     * @return mixed
     */
    public function getFundingsByUser(int $userId);

    /**
     * Get the total amount of fundings for the specified user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountByUser(int $userId);

    /**
     * Create a new funding record for the specified user.
     *
     * @param int $userId
     * @param float $amount
     * @param string|null $transactionId
     * @return mixed
     */
    public function createFunding(int $userId, float $amount, string $transactionId = null);

    /**
     * Update the funding status by funding ID.
     *
     * @param int $fundingId
     * @param string $status
     * @return mixed
     */
    public function updateFundingStatus(int $fundingId, string $status);

    /**
     * Get the most recent funding records for a user.
     *
     * @param int $userId
     * @param int $limit
     * @return mixed
     */
    public function getRecentFundingsByUser(int $userId, int $limit = 10);

    /**
     * Get the funding records within a specified date range.
     *
     * @param string $fromDate
     * @param string $toDate
     * @return mixed
     */
    public function getFundingsByDateRange(string $fromDate, string $toDate);

    /**
     * Get the total amount of fundings for all users.
     *
     * @return float
     */
    public function getTotalAmountForAllUsers();

    /**
     * Get funding records by status.
     *
     * @param string $status
     * @return mixed
     */
    public function getFundingsByStatus(string $status);

    /**
     * Get the total number of fundings for a specified user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalFundingsCountByUser(int $userId);
}
