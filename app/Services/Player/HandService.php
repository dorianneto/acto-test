<?php

namespace App\Services\Player;

use Illuminate\Support\Arr;

class HandService
{
    const CARDS_ALLOWED = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    public function build(array $cardList): Hand
    {
        $hand = new Hand();

        foreach ($cardList as $value) {
            $hand->addCard(new Card($value));
        }

        return $hand;
    }

    public function generate(int $handSize): Hand
    {
        $cardList = Arr::random(self::CARDS_ALLOWED, $handSize);

        return $this->build($cardList);
    }
}
