<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestShot;
use Illuminate\Http\Request;
use App\Services\ServiceShot;

class ControllerShot extends Controller
{
    /**
     * @var ServiceShot
     */
    public $service;

    /**
     * ControllerBoard constructor.
     * @param ServiceShot $service
     */
    public function __construct(ServiceShot $service)
    {
        $this->service = $service;
    }

    public function shot(RequestShot $request, $gameId)
    {
        return response()->json($this->service->shot($request->all(), $gameId));
    }
}
