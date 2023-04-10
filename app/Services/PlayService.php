<?php

namespace App\Services;

use App\Contracts\PlayRepositoryContract;
use App\Models\Play;
use Illuminate\Support\Collection;

class PlayService
{
    protected PlayRepositoryContract $playRepository;

    public function __construct(PlayRepositoryContract $playRepository)
    {
        $this->playRepository = $playRepository;
    }

    public function getUserPlays(int $userId, int $limit = 10): Collection
    {
        return $this->playRepository->getUserPlays($userId, $limit);
    }

    public function getRecentPlaysForGame(int $gameId, int $limit = 10): Collection
    {
        return $this->playRepository->getRecentPlaysForGame($gameId, $limit);
    }

    public function getUserProfit(int $userId): int
    {
        return $this->playRepository->getUserProfit($userId);
    }

    public function createPlay(array $playData): \Illuminate\Database\Eloquent\Model
    {
        return $this->playRepository->create($playData);
    }

    public function updatePlay(int $playId, array $playData): bool
    {
        return $this->playRepository->update($playId, $playData);
    }

    public function deletePlay(int $playId): bool
    {
        return $this->playRepository->delete($playId);
    }

    public function getPlayById(int $playId): ?Play
    {
        return $this->playRepository->findById($playId);
    }

    public function getAllPlays(int $limit = 10): Collection
    {
        return $this->playRepository->getAllPlays($limit);
    }

    public function getPlaysByGameId(int $gameId, int $limit = 10): Collection
    {
        return $this->playRepository->getPlaysByGameId($gameId, $limit);
    }
    public function placeBet(User $user, Game $game, int $betAmount, int $autoCashOut): \Illuminate\Database\Eloquent\Model
    {
        $playData = [
            'user_id' => $user->id,
            'game_id' => $game->id,
            'bet' => $betAmount,
            'auto_cash_out' => $autoCashOut
        ];

        return $this->createPlay($playData);
    }

    public function cashOutPlay(Play $play, int $cashOutAmount): bool
    {
        $playData = [
            'cash_out' => $cashOutAmount
        ];

        return $this->updatePlay($play->id, $playData);
    }

    public function calculateUserProfit(int $userId, int $limit = 10): int
    {
        $plays = $this->getUserPlays($userId, $limit);
        $profit = 0;

        foreach ($plays as $play) {
            $bet = $play->bet;
            $cashOut = $play->cash_out;
            $bonus = $play->bonus;
            $profit += ($cashOut - $bet) + $bonus;
        }

        return $profit;
    }

    public function isUserInGame(User $user, Game $game): bool
    {
        return $this->playRepository->isUserInGame($user->id, $game->id);
    }

    public function getActivePlays(Game $game): Collection
    {
        return $this->playRepository->getActivePlays($game->id);
    }

    public function getActivePlaysWithAutoCashOut(Game $game, int $autoCashOut): Collection
    {
        return $this->playRepository->getActivePlaysWithAutoCashOut($game->id, $autoCashOut);
    }

    public function getUserPlaysWithPagination(int $userId, int $perPage = 10)
    {
        return $this->playRepository->getUserPlaysWithPagination($userId, $perPage);
    }

    public function getLeaderboard(int $limit = 10): Collection
    {
        return $this->playRepository->getLeaderboard($limit);
    }

    public function getUserRank(int $userId): int
    {
        return $this->playRepository->getUserRank($userId);
    }

    public function getGameHistory(int $limit = 10): Collection
    {
        return $this->playRepository->getGameHistory($limit);
    }
    public function getPlaysByUserAndGame(int $userId, int $gameId): Collection
    {
        return $this->playRepository->getPlaysByUserAndGame($userId, $gameId);
    }

    public function getTotalBetAmountForGame(int $gameId): int
    {
        return $this->playRepository->getTotalBetAmountForGame($gameId);
    }

    public function getTotalBetAmountForUser(int $userId): int
    {
        return $this->playRepository->getTotalBetAmountForUser($userId);
    }

    public function getUserStats(int $userId): array
    {
        return $this->playRepository->getUserStats($userId);
    }

    public function getRecentPlaysWithUsers(int $limit = 10): Collection
    {
        return $this->playRepository->getRecentPlaysWithUsers($limit);
    }
    public function getActivePlaysForGame(int $gameId): Collection
    {
        return $this->playRepository->getActivePlaysForGame($gameId);
    }

    public function getCashedOutPlaysForGame(int $gameId): Collection
    {
        return $this->playRepository->getCashedOutPlaysForGame($gameId);
    }

    public function getTopWinningPlays(int $limit = 10): Collection
    {
        return $this->playRepository->getTopWinningPlays($limit);
    }

    public function getTopWinningPlaysByUser(int $userId, int $limit = 10): Collection
    {
        return $this->playRepository->getTopWinningPlaysByUser($userId, $limit);
    }

    public function getTopWinningPlaysForGame(int $gameId, int $limit = 10): Collection
    {
        return $this->playRepository->getTopWinningPlaysForGame($gameId, $limit);
    }
    public function getLatestPlays(int $limit = 10): Collection
    {
        return $this->playRepository->getLatestPlays($limit);
    }



    public function getUserPlaysForGame(int $userId, int $gameId): Collection
    {
        return $this->playRepository->getUserPlaysForGame($userId, $gameId);
    }

    public function getGamePlays(int $gameId, int $limit = 10): Collection
    {
        return $this->playRepository->getGamePlays($gameId, $limit);
    }

    public function getTopWinnersForGame(int $gameId, int $limit = 10): Collection
    {
        return $this->playRepository->getTopWinnersForGame($gameId, $limit);
    }

    public function getTopWinners(int $limit = 10): Collection
    {
        return $this->playRepository->getTopWinners($limit);
    }

    public function getBiggestBetsForGame(int $gameId, int $limit = 10): Collection
    {
        return $this->playRepository->getBiggestBetsForGame($gameId, $limit);
    }

    public function getBiggestBets(int $limit = 10): Collection
    {
        return $this->playRepository->getBiggestBets($limit);
    }


    public function getRecentPlays(int $limit = 10): Collection
    {
        return $this->playRepository->getRecentPlays($limit);
    }

    public function getMostPlayedGames(int $limit = 10): Collection
    {
        return $this->playRepository->getMostPlayedGames($limit);
    }

    public function getHighestCashouts(int $limit = 10): Collection
    {
        return $this->playRepository->getHighestCashouts($limit);
    }

    public function getLongestAutocashouts(int $limit = 10): Collection
    {
        return $this->playRepository->getLongestAutocashouts($limit);
    }
}
