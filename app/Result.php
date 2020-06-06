<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'user_score', 'opponent_score', 'user_win'];
}
