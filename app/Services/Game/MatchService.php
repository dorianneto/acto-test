<?php

namespace App\Services\Game;

use App\Repositories\ResultRepository;

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

    public function save(array $result): void
    {
        $this->resultRepository->save($result);
    }

    public function leadboard(): array
    {
        return $this->resultRepository->leadboard()->toArray() ?? [];
    }
}
