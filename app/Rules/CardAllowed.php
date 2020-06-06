<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardAllowed implements Rule
{
    const CARDS_ALLOWED = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];
    const CARDS_IN_HAND_MAX = 4;

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cardsCheck = array_filter($value, function($card) {
            return in_array($card, self::CARDS_ALLOWED);
        });

        return count($cardsCheck) === self::CARDS_IN_HAND_MAX;
    }

    /**
     * @return string|array
     */
    public function message()
    {
        return 'Card(s) not allowed.';
    }
}
