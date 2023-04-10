<?php

/**
 * This is the GameService class.
 * It acts as a layer between the GameRepository and the controllers.
 * It contains methods that implement the business logic of the application.
 */

namespace App\Services;

use App\Repositories\Contracts\GameRepositoryContract;

class GameService
{
    /**
     * @var GameRepositoryContract $gameRepository
     * The gameRepository variable holds an instance of the GameRepository.
     */
    protected $gameRepository;

    /**
     * The constructor method injects an instance of the GameRepository into the GameService.
     * @param GameRepositoryContract $gameRepository
     */
    public function __construct(GameRepositoryContract $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * The getCurrentGame method returns the current game object.
     * @return object
     */
    public function getCurrentGame(): object
    {
        return $this->gameRepository->getCurrentGame();
    }

    /**
     * The getLatestGames method returns the latest games.
     * @param int $limit The limit of the number of games to return.
     * @return object
     */
    public function getLatestGames(int $limit = 10): object
    {
        return $this->gameRepository->getLatestGames($limit);
    }

    /**
     * The createNewGame method creates a new game.
     * @param float $gameCrash The crash point for the new game.
     * @return object
     */
    public function createNewGame(float $gameCrash): object
    {
        return $this->gameRepository->createNewGame($gameCrash);
    }

    /**
     * The getAverageCrashPoint method returns the average crash point of all games.
     * @return float
     */
    public function getAverageCrashPoint(): float
    {
        return $this->gameRepository->getAverageCrashPoint();
    }

    /**
     * The endGame method ends a game.
     * @param int $gameId The ID of the game to end.
     * @return object
     */
    public function endGame(int $gameId): object
    {
        return $this->gameRepository->endGame($gameId);
    }

    /**
     * The getGameById method returns a game object by ID.
     * @param int $gameId The ID of the game to get.
     * @return object
     */
    public function getGameById(int $gameId): object
    {
        return $this->gameRepository->getGameById($gameId);
    }

    /**
     * The getGamesByCrashPointRange method returns games within a crash point range.
     * @param float $minCrashPoint The minimum crash point.
     * @param float $maxCrashPoint The maximum crash point.
     * @param int $limit The limit of the number of games to return.
     * @return object
     */
    public function getGamesByCrashPointRange(float $minCrashPoint, float $maxCrashPoint, int $limit = 10): object
    {
        return $this->gameRepository->getGamesByCrashPointRange($minCrashPoint, $maxCrashPoint, $limit);
    }

    /**
     * The getHighestCrashPoint method returns the highest crash point of all games.
     * @return float
     */
    public function getHighestCrashPoint(): float
    {
        return $this->gameRepository->getHighestCrashPoint();
    }

    /**
     * The getLowestCrashPoint method returns the lowest crash point of all games.
     * @return float
     */
    public function getLowestCrashPoint(): float
    {
        return $this->gameRepository->getLowestCrashPoint();
    }

    /**
     * The getGamesByPlayer method returns games played by a player.
     * @param int $userId The ID of the user.
     * @param int $limit The limit of the number of games to return.
     * @return object
     */
    public function getGamesByPlayer(int $userId, int $limit = 10): object
    {
        return $this->gameRepository->getGamesByPlayer($userId, $limit);
    }

    /**
     * The getTotalAmountBet method returns the total amount bet on all games.
     * @return float
     */
    public function getTotalAmountBet(): float
    {
        return $this->gameRepository->getTotalAmountBet();
    }

    /**
     * The getTotalAmountWon method returns the total amount won on all games.
     * @return float
     */
    public function getTotalAmountWon(): float
    {
        return $this->gameRepository->getTotalAmountWon();
    }

    /**
     * The getRecentGamesWithCrashPoints method returns the most recent games with their crash points.
     * @param int $limit The limit of the number of games to return.
     * @return object
     */
    public function getRecentGamesWithCrashPoints(int $limit = 10): object
    {
        return $this->gameRepository->getRecentGamesWithCrashPoints($limit);
    }

    /**
     * The getTotalGamesPlayedByUser method returns the total number of games played by a user.
     * @param int $userId The ID of the user.
     * @return int
     */
    public function getTotalGamesPlayedByUser(int $userId): int
    {
        return $this->gameRepository->getTotalGamesPlayedByUser($userId);
    }

    /**
     * The getLongestStreakAboveCrashPoint method returns the longest streak above a given crash point.
     * @param float $value The crash point value.
     * @return int
     */
    public function getLongestStreakAboveCrashPoint(float $value): int
    {
        return $this->gameRepository->getLongestStreakAboveCrashPoint($value);
    }

    /**
     * The getLongestStreakBelowCrashPoint method returns the longest streak below a given crash point.
     * @param float $value The crash point value.
     * @return int
     */
    public function getLongestStreakBelowCrashPoint(float $value): int
    {
        return $this->gameRepository->getLongestStreakBelowCrashPoint($value);
    }

    /**
     * The getTotalAmountWagered method returns the total amount wagered on all games.
     * @return float
     */
    public function getTotalAmountWagered(): float
    {
        return $this->gameRepository->getTotalAmountWagered();
    }

    /**
     * The getTotalAmountWageredByUser method returns the total amount wagered by a user on all games.
     * @param int $userId The ID of the user.
     * @return float
     */
    public function getTotalAmountWageredByUser(int $userId): float
    {
        return $this->gameRepository->getTotalAmountWageredByUser($userId);
    }

    /**
     * The getNumberOfGamesAboveCrashPoint method returns the number of games above a given crash point.
     * @param float $value The crash point value.
     * @return int
     */
    public function getNumberOfGamesAboveCrashPoint(float $value): int
    {
        return $this->gameRepository->getNumberOfGamesAboveCrashPoint($value);
    }

    /**
     * The getNumberOfGamesBelowCrashPoint method returns the number of games below a given crash point.
     * @param float $value The crash point value.
     * @return int
     */
    public function getNumberOfGamesBelowCrashPoint(float $value): int
    {
        return $this->gameRepository->getNumberOfGamesBelowCrashPoint($value);
    }

    /**
     * The getMostRecentGame method returns the most recent game object.
     * @return object
     */
    public function getMostRecentGame(): object
    {
        return $this->gameRepository->getMostRecentGame();
    }
}

