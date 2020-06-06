<?php

namespace App\Services\Game;

use App\Services\Player\Hand;

class JudgeService
{
    public function evaluate(Hand $userHand, Hand $opponentHand): array
    {
        $userScore = 0;
        $opponentScore = 0;

        $userHand = $userHand->getCards();
        $opponentHand = $opponentHand->getCards();

        for ($i = 0; $i < count($userHand); $i++) {
            if ($userHand[$i]->getValue() > $opponentHand[$i]->getValue()) {
                $userScore++;
                continue;
            }

            $opponentScore++;
        }

        return [
            'user' => $userScore,
            'opponent' => $opponentScore,
        ];
    }

    public function checkUserWon(array $scores): bool
    {
        return $scores['user'] > $scores['opponent'];
    }
}
