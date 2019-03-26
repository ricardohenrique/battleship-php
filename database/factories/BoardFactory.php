<?php

use Faker\Generator as Faker;
use App\Services\ServiceBoard;
use App\Models\Board;

$factory->define(Board::class, function (Faker $faker) {
    return [
        'field' => json_encode(ServiceBoard::buildField())
    ];
});
