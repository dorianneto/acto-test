<?php

namespace App\Rules;

use App\Services\Player\Hand;
use App\Services\Player\HandService;
use Illuminate\Contracts\Validation\Rule;

class HandChecker implements Rule
{
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $hand = array_filter($value, function($card) {
            return in_array($card, HandService::CARDS_ALLOWED);
        });

        return count($hand) === count($value);
    }

    /**
     * @return string|array
     */
    public function message()
    {
        return 'There are cards not allowed in this hand.';
    }
}
