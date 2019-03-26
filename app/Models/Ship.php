<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $table = 'ships';

    protected $fillable = [
        'name',
        'size_x',
        'size_y',
        'initials'
    ];
}
