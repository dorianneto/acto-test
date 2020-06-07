<?php

namespace App\Services\Player;

class Hand
{
    /**
     * @var array
     */
    private $cards = [];

    public function getCards(): array
    {
        return $this->cards;
    }

    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function count(): int
    {
        return count($this->getCards());
    }

    public function toArray(): array
    {
        return array_map(function($value) {
            return $value->getRealValue();
        }, $this->getCards());
    }
}
