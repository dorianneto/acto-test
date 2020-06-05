<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Result;
use Faker\Generator as Faker;

$factory->define(Result::class, function (Faker $faker) {
    $userScore = $faker->numberBetween(0, 4);
    $opponentScore = $faker->numberBetween(0, 4);

    $userWin = $userScore > $opponentScore ? true : false;

    return [
        'name' => $faker->name,
        'user_score' => $userScore,
        'opponent_score' => $opponentScore,
        'user_win' => $userWin,
    ];
});
