<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'board_one_id',
        'board_two_id',
        'board_winner_id',
        'status',
    ];
}
