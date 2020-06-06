<?php

use Illuminate\Support\Facades\Route;

Route::prefix('game')->name('api.game.')->group(function() {
    Route::post('new', 'GameController@new')->name('new');
    Route::post('play', 'GameController@play')->name('play');
    Route::get('leadboard', 'GameController@leadboard')->name('leadboard');
});
