<?php

namespace App\Contracts;

interface GameRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get the current game.
     *
     * @return \App\Models\Game
     */
    public function getCurrentGame();

    /**
     * Get the latest games.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatestGames(int $limit = 10);

    /**
     * Get a game by its ID.
     *
     * @param int $gameId
     * @return \App\Models\Game|null
     */
    public function getGameById(int $gameId);

    /**
     * Get the total number of games played.
     *
     * @return int
     */
    public function getTotalGamesPlayed();

    /**
     * Get games with a specific crash point range.
     *
     * @param float $minCrashPoint
     * @param float $maxCrashPoint
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesByCrashPointRange(float $minCrashPoint, float $maxCrashPoint, int $limit = 10);

    /**
     * Get the average crash point for all games.
     *
     * @return float
     */
    public function getAverageCrashPoint();

    /**
     * Create a new game and store it in the database.
     *
     * @param float $gameCrash
     * @return \App\Models\Game
     */
    public function createNewGame(float $gameCrash);
    /**
     * Get the highest crash point recorded in the game history.
     *
     * @return float
     */
    public function getHighestCrashPoint();

    /**
     * Get the lowest crash point recorded in the game history.
     *
     * @return float
     */
    public function getLowestCrashPoint();

    /**
     * Get games with a specific player.
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesByPlayer(int $userId, int $limit = 10);

    /**
     * Get the total amount bet in all games.
     *
     * @return int
     */
    public function getTotalAmountBet();

    /**
     * Get the total amount won in all games.
     *
     * @return int
     */
    public function getTotalAmountWon();

    /**
     * End the current game and mark it as ended in the database.
     *
     * @param int $gameId
     * @return \App\Models\Game
     */
    public function endGame(int $gameId);
    /**
     * Get recent games with their crash points.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentGamesWithCrashPoints(int $limit = 10);

    /**
     * Get the total number of games played by a specific user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalGamesPlayedByUser(int $userId);

    /**
     * Get the longest streak of games with crash points above a specific value.
     *
     * @param float $value
     * @return int
     */
    public function getLongestStreakAboveCrashPoint(float $value);

    /**
     * Get the longest streak of games with crash points below a specific value.
     *
     * @param float $value
     * @return int
     */
    public function getLongestStreakBelowCrashPoint(float $value);

    /**
     * Get the total amount wagered in all games.
     *
     * @return int
     */
    public function getTotalAmountWagered();

    /**
     * Get the total amount wagered by a specific user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalAmountWageredByUser(int $userId);

    /**
     * Get the total number of games with crash points above a specific value.
     *
     * @param float $value
     * @return int
     */
    public function getNumberOfGamesAboveCrashPoint(float $value);

    /**
     * Get the total number of games with crash points below a specific value.
     *
     * @param float $value
     * @return int
     */
    public function getNumberOfGamesBelowCrashPoint(float $value);

    /**
     * Get the most recent game.
     *
     * @return \App\Models\Game
     */
    public function getMostRecentGame();

    /**
     * Get the most recent games with a limit.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMostRecentGames(int $limit);
    /**
     * Get games with the highest crash points.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHighestCrashPoints(int $limit);

    /**
     * Get games with the lowest crash points.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLowestCrashPoints(int $limit);

    /**
     * Get the total sum of crash points for a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalCrashPointsByUser(int $userId);

    /**
     * Get the total sum of crash points for all games.
     *
     * @return float
     */
    public function getTotalCrashPoints();

    /**
     * Get games within a specific date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesWithinDateRange(string $startDate, string $endDate);
}
