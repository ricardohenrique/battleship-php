<?php

namespace App\Services;

use App\Supports\Battleship;
use App\Models\Game as ModelGame;
use Log;

class ServiceGame
{
    use Battleship;

    public $modelGame;

    public $serviceBoard;

    public $serviceShip;

    public function __construct(ModelGame $modelGame, ServiceBoard $serviceBoard, ServiceShip $serviceShip)
    {
        $this->modelGame = $modelGame;
        $this->serviceBoard = $serviceBoard;
        $this->serviceShip = $serviceShip;
    }
    public function startGame(): ModelGame
    {
        $data['board_one'] = $this->serviceBoard->createBoard();
        $this->setShips($data['board_one']);

        $data['board_two'] = $this->serviceBoard->createBoard();
        $this->setShips($data['board_two']);

        $game = ModelGame::create([
            'board_one_id' => $data['board_one']->id,
            'board_two_id' => $data['board_two']->id,
        ]);

        return $game;
    }

    private function setShips($board)
    {
        try {
            $ships = $this->serviceShip->getAll();
            $excluded = [];
            $data['position_x'] = 'a';
            $data['vertical'] = false;

            foreach ($ships as $ship) {
                $number = $this->randomNumber(0,(self::$NUMBERCOLUMNS-1), $excluded);
                $excluded[] = $number;
                $data['position_y'] = $number;
                $board = $this->serviceBoard->setShipOnBoard($board->id, $ship->id, $data);
            }
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    private function randomNumber($from, $to, array $excluded = [])
    {
        do {
            $number = mt_rand($from, $to);
        } while (in_array($number, $excluded, true));

        return $number;
    }
}
