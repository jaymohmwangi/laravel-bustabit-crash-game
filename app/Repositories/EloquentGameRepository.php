<?php

namespace App\Repositories;

use App\Contracts\GameRepositoryContract;
use App\Models\Game;
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
     * {@inheritdoc}
     */
    public function getHighestCrashPoints(int $limit)
    {
        return $this->model->orderBy('game_crash', 'desc')->limit($limit)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getLowestCrashPoints(int $limit)
    {
        return $this->model->orderBy('game_crash', 'asc')->limit($limit)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCrashPointsByUser(int $userId)
    {
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->sum('game_crash');
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalCrashPoints()
    {
        return $this->model->sum('game_crash');
    }

    /**
     * {@inheritdoc}
     */
    public function getGamesWithinDateRange(string $startDate, string $endDate)
    {
        return $this->model->whereBetween('created_at', [$startDate, $endDate])->get();
    }


    /**
     * {@inheritdoc}
     */
    public function getMostRecentGames(int $limit)
    {
        // Fetch the most recent games, ordered by creation date
        return $this->model->orderBy('created_at', 'desc')->limit($limit)->get();
    }


    /**
     * {@inheritdoc}
     */
    public function getAverageCrashPointByUser(int $userId)
    {
        // Calculate the average crash point for a specific user
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->avg('game_crash');
    }

    /**
     * {@inheritdoc}
     */
    public function getGameCountByUser(int $userId)
    {
        // Count the total number of games played by a specific user
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    }
    /**
     * {@inheritdoc}
     */
    public function getGamesBetweenDates(Carbon $fromDate, Carbon $toDate)
    {
        // Fetch games that were created between two dates
        return $this->model->whereBetween('created_at', [$fromDate, $toDate])->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getGamesWithCrashPointGreaterThan(int $crashPoint)
    {
        // Fetch games with a crash point greater than the specified value
        return $this->model->where('game_crash', '>', $crashPoint)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getGamesWithCrashPointLessThan(int $crashPoint)
    {
        // Fetch games with a crash point less than the specified value
        return $this->model->where('game_crash', '<', $crashPoint)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalGamesPlayed()
    {
        // Count the total number of games played across all users
        return $this->model->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getGamesWithMostPlayers(int $limit)
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
     * {@inheritdoc}
     */
    public function getGamesByUser(int $userId)
    {
        // Fetch games that were played by a specific user
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }


    /**
     * {@inheritdoc}
     */
    public function getGamesByCrashRange(int $minCrash, int $maxCrash)
    {
        // Fetch games with a crash point within the specified range
        return $this->model->whereBetween('game_crash', [$minCrash, $maxCrash])->get();
    }
    public function getCurrentGame()
    {
        // Fetch the current game
        return $this->model->where('ended', false)->get();
    }

    public function getLatestGames(int $limit = 10)
    {
        // Fetch the latest games
        return $this->model->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function getGameById(int $gameId)
    {
        // Fetch a game by its ID
        return $this->model->find($gameId);
    }

    public function getGamesByCrashPointRange(float $minCrashPoint, float $maxCrashPoint, int $limit = 10)
    {
        // Fetch games within a crash point range
        return $this->model->whereBetween('game_crash', [$minCrashPoint, $maxCrashPoint])->take($limit)->get();
    }

    public function getAverageCrashPoint()
    {
        // Calculate the average crash point
        return $this->model->avg('game_crash');
    }

    public function createNewGame(float $gameCrash)
    {
        // Create a new game
        return $this->model->create(['game_crash' => $gameCrash, 'status' => 'in_progress']);
    }

    public function getHighestCrashPoint()
    {
        // Fetch the highest crash point
        return $this->model->max('game_crash');
    }

    public function getLowestCrashPoint()
    {
        // Fetch the lowest crash point
        return $this->model->min('game_crash');
    }

    public function getGamesByPlayer(int $userId, int $limit = 10)
    {
        // Fetch games by a specific player
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->take($limit)->get();
    }

    public function getTotalAmountBet()
    {
        // Calculate the total amount bet
        return $this->model->sum('total_bet');
    }

    public function getTotalAmountWon()
    {
        // Calculate the total amount won
        return $this->model->sum('total_won');
    }

    public function endGame(int $gameId)
    {
        // End a game by updating its status
        return $this->model->where('id', $gameId)->update(['ended' => true]);
    }

    public function getRecentGamesWithCrashPoints(int $limit = 10)
    {
        // Fetch recent games with their crash points
        return $this->model->select('id', 'game_crash')->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function getTotalGamesPlayedByUser(int $userId)
    {
        // Count the total games played by a specific user
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    }
    public function getLongestStreakAboveCrashPoint(float $value)
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

    public function getLongestStreakBelowCrashPoint(float $value)
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

    public function getTotalAmountWagered()
    {
        // Calculate the total amount wagered across all games
        return $this->model->with('plays')->get()->sum(function ($game) {
            return $game->plays->sum('bet');
        });
    }

    public function getTotalAmountWageredByUser(int $userId)
    {
        // Calculate the total amount wagered by a specific user across all games
        return $this->model->whereHas('plays', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get()->sum(function ($game) {
            return $game->plays->sum('bet');
        });
    }

    public function getNumberOfGamesAboveCrashPoint(float $value)
    {
        // Count the number of games with crash points above the given value
        return $this->model->where('game_crash', '>', $value)->count();
    }

    public function getNumberOfGamesBelowCrashPoint(float $value)
    {
        // Count the number of games with crash points below the given value
        return $this->model->where('game_crash', '<', $value)->count();
    }

    public function getMostRecentGame()
    {
        // Fetch the most recent game
        return $this->model->orderBy('created_at', 'desc')->first();
    }


}
