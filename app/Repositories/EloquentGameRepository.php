<?php

namespace App\Repositories;

use App\Contracts\GameRepositoryContract;
use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class EloquentGameRepository extends EloquentBaseRepository implements GameRepositoryContract
{
    /**
     * EloquentGameRepository constructor.
     *
     * @param Game $model
     */
    public function __construct(Game $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the games with the highest crash points.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHighestCrashPoints(int $limit): Collection
    {
        return $this->model->orderBy('game_crash', 'desc')->limit($limit)->get();
    }

    /**
     * Get the games with the lowest crash points.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLowestCrashPoints(int $limit): Collection
    {
        return $this->model->orderBy('game_crash', 'asc')->limit($limit)->get();
    }

    /**
     * Get the total crash points for a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalCrashPointsByUser(int $userId): float
    {
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->sum('game_crash');
    }

    /**
     * Get the total crash points across all games.
     *
     * @return float
     */
    public function getTotalCrashPoints(): float
    {
        return $this->model->sum('game_crash');
    }

    /**
     * Get the games within a specific date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesWithinDateRange(string $startDate, string $endDate): Collection
    {
        return $this->model->whereBetween('created_at', [$startDate, $endDate])->get();
    }

    /**
     * Get the most recent games.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMostRecentGames(int $limit): Collection
    {
        return $this->model->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * Get the average crash point for a specific user.
     *
     * @param int $userId
     * @return float
     */
    public function getAverageCrashPointByUser(int $userId): float
    {
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->avg('game_crash');
    }

    /**
     * Get the total number of games played by a specific user.
     *
     * @param int $userId
     * @return int
     */
    public function getGameCountByUser(int $userId): int
    {
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    }
    /**
     * Get all games created between two dates.
     *
     * @param Carbon $fromDate
     * @param Carbon $toDate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesBetweenDates(Carbon $fromDate, Carbon $toDate): Collection
    {
        // Fetch games that were created between two dates
        return $this->model->whereBetween('created_at', [$fromDate, $toDate])->get();
    }

    /**
     * Get all games with a crash point greater than the specified value.
     *
     * @param int $crashPoint
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesWithCrashPointGreaterThan(int $crashPoint): Collection
    {
        // Fetch games with a crash point greater than the specified value
        return $this->model->where('game_crash', '>', $crashPoint)->get();
    }

    /**
     * Get all games with a crash point less than the specified value.
     *
     * @param int $crashPoint
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesWithCrashPointLessThan(int $crashPoint): Collection
    {
        // Fetch games with a crash point less than the specified value
        return $this->model->where('game_crash', '<', $crashPoint)->get();
    }

    /**
     * Get the total number of games played across all users.
     *
     * @return int
     */
    public function getTotalGamesPlayed(): int
    {
        // Count the total number of games played across all users
        return $this->model->count();
    }

    /**
     * Get the games with the most players.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesWithMostPlayers(int $limit): Collection
    {
        // Fetch the games with the most players (using a join on the 'plays' table)
        return $this->model->select('games.*', \DB::raw('COUNT(plays.id) as player_count'))
            ->join('plays', 'games.id', '=', 'plays.game_id')
            ->groupBy('games.id')
            ->orderBy('player_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get all games played by a specific user.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesByUser(int $userId): Collection
    {
        // Fetch games that were played by a specific user
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }


    /**
     * Fetch games with a crash point within the specified range.
     *
     * @param int $minCrash
     * @param int $maxCrash
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesByCrashRange(int $minCrash, int $maxCrash): Collection
    {
        return $this->model->whereBetween('game_crash', [$minCrash, $maxCrash])->get();
    }

    /**
     * Fetch the current game.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCurrentGame(): Collection
    {
        return $this->model->where('ended', false)->get();
    }

    /**
     * Fetch the latest games.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLatestGames(int $limit = 10): Collection
    {
        return $this->model->orderBy('created_at', 'desc')->take($limit)->get();
    }

    /**
     * Fetch a game by its ID.
     *
     * @param int $gameId
     * @return \App\Models\Game|null
     */
    public function getGameById(int $gameId): ?Game
    {
        return $this->model->find($gameId);
    }

    /**
     * Fetch games within a crash point range.
     *
     * @param float $minCrashPoint
     * @param float $maxCrashPoint
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesByCrashPointRange(float $minCrashPoint, float $maxCrashPoint, int $limit = 10): Collection
    {
        return $this->model->whereBetween('game_crash', [$minCrashPoint, $maxCrashPoint])->take($limit)->get();
    }

    /**
     * Calculate the average crash point.
     *
     * @return float
     */
    public function getAverageCrashPoint(): float
    {
        return $this->model->avg('game_crash');
    }

    /**
     * Create a new game.
     *
     * @param float $gameCrash
     * @return \App\Models\Game
     */
    public function createNewGame(float $gameCrash): Game
    {
        return $this->model->create(['game_crash' => $gameCrash, 'status' => 'in_progress']);
    }

    /**
     * Fetch the highest crash point.
     *
     * @return float
     */
    public function getHighestCrashPoint(): float
    {
        return $this->model->max('game_crash');
    }

    /**
     * Fetch the lowest crash point.
     *
     * @return float
     */
    public function getLowestCrashPoint(): float
    {
        return $this->model->min('game_crash');
    }
    /**
     * Fetch games by a specific player.
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGamesByPlayer(int $userId, int $limit = 10): Collection
    {
        // Fetch games by a specific player
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->take($limit)->get();
    }

    /**
     * Calculate the total amount bet.
     *
     * @return float
     */
    public function getTotalAmountBet(): float
    {
        // Calculate the total amount bet
        return $this->model->sum('total_bet');
    }

    /**
     * Calculate the total amount won.
     *
     * @return float
     */
    public function getTotalAmountWon(): float
    {
        // Calculate the total amount won
        return $this->model->sum('total_won');
    }

    /**
     * End a game by updating its status.
     *
     * @param int $gameId
     * @return int
     */
    public function endGame(int $gameId): int
    {
        // End a game by updating its status
        return $this->model->where('id', $gameId)->update(['ended' => true]);
    }

    /**
     * Fetch recent games with their crash points.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentGamesWithCrashPoints(int $limit = 10): Collection
    {
        // Fetch recent games with their crash points
        return $this->model->select('id', 'game_crash')->orderBy('created_at', 'desc')->take($limit)->get();
    }

    /**
     * Count the total games played by a specific user.
     *
     * @param int $userId
     * @return int
     */
    public function getTotalGamesPlayedByUser(int $userId): int
    {
        // Count the total games played by a specific user
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    }

    /**
     * Fetch the longest streak of games with crash points above the given value.
     * This implementation is a simplified example and might not be the most efficient way to achieve this.
     *
     * @param float $value
     * @return int
     */
    public function getLongestStreakAboveCrashPoint(float $value): int
    {
        // Fetch the longest streak of games with crash points above the given value
        // This implementation is a simplified example and might not be the most efficient way to achieve this
        $streak = 0;
        $maxStreak = 0;

        $games = $this->model->orderBy('created_at', 'asc')->get();

        foreach ($games as $game) {
            if ($game->game_crash > $value) {
                $streak++;
                $maxStreak = max($maxStreak, $streak);
            } else {
                $streak = 0;
            }
        }

        return $maxStreak;
    }
    /**
     * Get the longest streak of games with crash points below the given value.
     *
     * @param float $value
     * @return int
     */
    public function getLongestStreakBelowCrashPoint(float $value): int
    {
        // Fetch the longest streak of games with crash points below the given value
        // This implementation is a simplified example and might not be the most efficient way to achieve this
        $streak = 0;
        $maxStreak = 0;

        $games = $this->model->orderBy('created_at', 'asc')->get();

        foreach ($games as $game) {
            if ($game->game_crash < $value) {
                $streak++;
                $maxStreak = max($maxStreak, $streak);
            } else {
                $streak = 0;
            }
        }

        return $maxStreak;
    }

    /**
     * Calculate the total amount wagered across all games.
     *
     * @return float
     */
    public function getTotalAmountWagered(): float
    {
        // Calculate the total amount wagered across all games
        return $this->model->with('plays')->get()->sum(function ($game) {
            return $game->plays->sum('bet');
        });
    }

    /**
     * Calculate the total amount wagered by a specific user across all games.
     *
     * @param int $userId
     * @return float
     */
    public function getTotalAmountWageredByUser(int $userId): float
    {
        // Calculate the total amount wagered by a specific user across all games
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get()->sum(function ($game) {
            return $game->plays->sum('bet');
        });
    }

    /**
     * Count the number of games with crash points above the given value.
     *
     * @param float $value
     * @return int
     */
    public function getNumberOfGamesAboveCrashPoint(float $value): int
    {
        // Count the number of games with crash points above the given value
        return $this->model->where('game_crash', '>', $value)->count();
    }

    /**
     * Count the number of games with crash points below the given value.
     *
     * @param float $value
     * @return int
     */
    public function getNumberOfGamesBelowCrashPoint(float $value): int
    {
        // Count the number of games with crash points below the given value
        return $this->model->where('game_crash', '<', $value)->count();
    }

    /**
     * Fetch the most recent game.
     *
     * @return mixed
     */
    public function getMostRecentGame()
    {
        // Fetch the most recent game
        return $this->model->orderBy('created_at', 'desc')->first();
    }


}
