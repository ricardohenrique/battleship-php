<?php

namespace App\Services;

use App\Supports\Battleship;
use App\Models\Shot as ModelShot;
use App\Models\Board as ModelBoard;

class ServiceShot
{
    use Battleship;

    public $shot;

    public $serviceBoard;

    public function __construct(ModelShot $shot, ServiceBoard $serviceBoard)
    {
        $this->shot = $shot;
        $this->serviceBoard = $serviceBoard;
    }

    public function shot(array $data, $gameId)
    {
        $positionX = $this->getIndexLetters($data['position_x']);
        $positionY = $this->getIndexNumbers($data['position_y']);

        $boardTo = $this->serviceBoard->getById($data['board_to']);
        $result = $this->pullTheTrigger($positionX, $positionY, $boardTo, $data['board_from'], $gameId);

        return $result;
    }

    private function pullTheTrigger(int $positionX, int $positionY, ModelBoard &$board, int $fromId, int $gameId)
    {
        $data['game_id'] = $gameId;
        $data['position_x'] = $positionX;
        $data['position_y'] = $positionY;
        $data['from'] = $fromId;
        $data['to'] = $board->id;
        $data['hit'] = false;

        $newBoard = $board->field;
        if($board[$positionX][$positionY] != 0) {
            $data['hit'] = true;
        }

        $newBoard[$positionX][$positionY] = 0;
        $board->field = json_encode($newBoard);
        $board->save();

        $shot = ModelShot::create($data);

        return $shot;
    }
}
