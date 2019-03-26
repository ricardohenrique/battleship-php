<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shot extends Model
{
    protected $table = 'shots';

    protected $fillable = [
        'game_id',
        'from',
        'to',
        'position_x',
        'position_y',
        'hit'
    ];
}
