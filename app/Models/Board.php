<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';

    protected $fillable = [
        'field',
    ];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFieldAttribute($value)
    {
        return json_decode($value);
    }
}
