<?php

namespace App\Services\Game;

use App\Services\Player\Hand;

class Match
{
    /**
     * @var \App\Services\Player\Hand
     */
    private $userHand;

    /**
     * @var \App\Services\Player\Hand
     */
    private $opponentHand;

    /**
     * @var integer
     */
    private $userScore = 0;

    /**
     * @var integer
     */
    private $opponentScore = 0;

    public function __construct(Hand $userHand, Hand $opponentHand)
    {
        $this->userHand = $userHand;
        $this->opponentHand = $opponentHand;
    }

    public function getUserHand(): Hand
    {
        return $this->userHand;
    }

    public function getOpponentHand(): Hand
    {
        return $this->opponentHand;
    }

    public function getUserScore(): int
    {
        return $this->userScore;
    }

    public function addPointToUser(): void
    {
        $this->userScore += 1;
    }

    public function getOpponentScore(): int
    {
        return $this->opponentScore;
    }

    public function addPointToOpponent(): void
    {
        $this->opponentScore += 1;
    }
}
