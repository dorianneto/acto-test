<?php

namespace App\Services\Player;

class Card
{
    /**
     * @var string
     */
    private $realValue;

    /**
     * @var array
     */
    private $value = [
        '2' => 1,
        '3' => 2,
        '4' => 3,
        '5' => 4,
        '6' => 5,
        '7' => 6,
        '8' => 7,
        '9' => 8,
        '10' => 9,
        'J' => 10,
        'Q' => 11,
        'K' => 12,
        'A' => 13,
    ];

    public function __construct(string $realValue)
    {
        $this->realValue = $realValue;
    }

    public function getValue(): string
    {
        return $this->value[$this->realValue];
    }

    public function getRealValue(): string
    {
        return $this->realValue;
    }
}
