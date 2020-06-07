<?php

namespace App\Services\Game;

use App\Repositories\ResultRepository;
use App\Services\Player\Hand;
use Exception;

class MatchService
{
    /**
     * @var \App\Repositories\ResultRepository
     */
    private $resultRepository;

    public function __construct(ResultRepository $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function create(Hand $userHand, Hand $opponentHand): Match
    {
        if ($userHand->count() === 0 || $opponentHand->count() === 0) {
            throw new Exception("a match cannot be created with an empty hand.");
        }

        return new Match($userHand, $opponentHand);
    }

    public function save(array $result): void
    {
        $this->resultRepository->save($result);
    }

    public function leadboard(): array
    {
        return $this->resultRepository->leadboard()->toArray() ?? [];
    }
}
