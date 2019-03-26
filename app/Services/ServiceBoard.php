<?php

namespace App\Services;


use App\Supports\Battleship;
use App\Models\Board as ModelBoard;
use App\Models\Ship as ModelShip;
use App\Exceptions\IllegalPositionException;
use Log;

class ServiceBoard
{
    use Battleship;

    public $board;

    public $serviceShip;

    public function __construct(ModelBoard $board, ServiceShip $serviceShip)
    {
        $this->serviceShip = $serviceShip;
        $this->board = $board;
    }

    public function getAll()
    {
        return $this->board->all();
    }

    public function getById(int $id)
    {
        return $this->board->find($id);
    }

    public function createBoard(): ModelBoard
    {
        $board = $this->board->create(['field' => json_encode(self::buildField())]);
        return $board;
    }

    public function setShipOnBoard(int $boardId, int $shipId, array $data)
    {
        $positionX = $this->getIndexLetters($data['position_x']);
        $positionY = $this->getIndexNumbers($data['position_y']);
        $ship      = $this->serviceShip->getById($shipId);
        $board     = $this->getById($boardId);
        $vertical  = $data['vertical'];

        if (!$this->validatePosition($positionX, $positionY, $ship, $board, $vertical))
        {
            throw new IllegalPositionException("Illegal position", 400);
        }

        $field = $this->putShipOnBoard($positionX, $positionY, $ship, $board->field, $vertical);

        $board->field = json_encode($field);
        $board->save();

        return $board;
    }

    private function putShipOnBoard(int $positionX, int $positionY, ModelShip $ship, array $field, $vertical = true): array
    {
        if($vertical === false){
            $this->swapTwoVariables($positionX, $positionY);
        }
        $maxX = $positionX + $ship->size_x;
        $maxY = $positionY + $ship->size_y;

        for ($column = $positionX; $column < $maxX; $column++)
        {
            for ($line = $positionY; $line < $maxY; $line++)
            {
                if ($vertical) {
                    $field[$line][$column] = $ship->initials;
                }
                else{
                    $field[$column][$line] = $ship->initials;
                }
            }
        }

        return $field;
    }

    private function validatePosition(int $positionX, int $positionY, ModelShip $ship, ModelBoard $board, $vertical = true): bool
    {
        if(!$vertical){
            $this->swapTwoVariables($positionX, $positionY);
        }
        if (($positionX+$ship->size_x) > count($board->field)) {
            return false;
        }

        if(($positionY+$ship->size_y) > count($board->field[0])) {
            return false;
        }

        return true;
    }

    private function swapTwoVariables(&$x, &$y) {
        $x ^= $y ^= $x ^= $y;
    }
}
