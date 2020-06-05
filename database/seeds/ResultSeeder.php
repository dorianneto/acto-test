<?php

use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    const RESULTS_AMOUNT = 15;

    public function run(): void
    {
        factory(App\Result::class, self::RESULTS_AMOUNT)->create();
    }
}
