<?php

namespace App\Services\Game;

use Exception;

class JudgeService
{
    public function evaluateMatch(Match $match): Match
    {
        $this->preEvaluate($match);

        $userCards = $match->getUserHand()->getCards();
        $opponentCards = $match->getOpponentHand()->getCards();

        for ($i = 0; $i < $match->getUserHand()->count(); $i++) {
            if ($userCards[$i]->getValue() > $opponentCards[$i]->getValue()) {
                $match->addPointToUser();
                continue;
            }

            $match->addPointToOpponent();
        }

        return $match;
    }

    protected function preEvaluate(Match $match): void
    {
        $this->scoreCheck($match->getUserScore(), $match->getOpponentScore());
        $this->handSizeCheck($match->getUserHand()->count(), $match->getOpponentHand()->count());
    }

    protected function scoreCheck(int $userScore, int $opponentScore): void
    {
        if ($userScore !== 0 || $opponentScore !== 0) {
            throw new Exception("The scores from a match need to be zeroed so the match can be evaluated.");
        }
    }

    protected function handSizeCheck(int $userHandSize, int $opponentHandSize): void
    {
        if ($userHandSize !== $opponentHandSize) {
            throw new Exception("Both players need to have the same amount of cards in their hands.");
        }
    }

    public function checkUserWon(int $userScore, int $opponentScore): bool
    {
        return $userScore > $opponentScore;
    }
}
