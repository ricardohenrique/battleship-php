<?php

namespace App\Http\Controllers;

use App\Services\ServiceShip;
use Illuminate\Http\Request;

class ControllerShip extends Controller
{
    /**
     * @var ServiceShip
     */
    public $service;

    /**
     * ControllerShip constructor.
     * @param ServiceShip $service
     */
    public function __construct(ServiceShip $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }
}
