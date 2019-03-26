<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestBoardShip;
use App\Services\ServiceBoard;

class ControllerBoard extends Controller
{
    /**
     * @var ServiceBoard
     */
    public $service;

    /**
     * ControllerBoard constructor.
     * @param ServiceBoard $service
     */
    public function __construct(ServiceBoard $service)
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

    public function store(Request $request)
    {
        return response()->json($this->service->createBoard());
    }

    public function putShip(RequestBoardShip $request, $boardId, $shipId)
    {
        return response()->json($this->service->setShipOnBoard($boardId, $shipId, $request->all()));
    }
}
