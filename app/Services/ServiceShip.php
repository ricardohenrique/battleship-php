<?php

namespace App\Services;

use App\Models\Ship as ModelShip;


class ServiceShip
{
    public $ship;

    public function __construct(ModelShip $ship)
    {
        $this->ship = $ship;
    }

    public function getAll()
    {
        return $this->ship->all();
    }

    public function getById(int $id)
    {
        return $this->ship->find($id);
    }
}
