<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServiceGame;

class ControllerGame extends Controller
{
    /**
     * @var ServiceGame
     */
    public $service;

    /**
     * ControllerBoard constructor.
     * @param ServiceGame $service
     */
    public function __construct(ServiceGame $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json($this->service->startGame());
    }
}
