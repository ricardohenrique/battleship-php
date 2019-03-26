<?php

namespace App\Services;

use App\Models\Board as ModelBoard;
use App\Models\Ship as ModelShip;
use App\Services\ServiceShip;
use App\Exceptions\IllegalPositionException;
use Log;

class ServiceBoard
{
    public $board;

    public $serviceShip;

    /**
     * Number of columns on the board
     */
    public const NUMBERCOLUMNS = 10;

    /**
     * Number of the lines on the board
     */
    public const NUMBERLINES = 10;


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

    /**
     * @return array
     */
    public function createBoard(): array
    {
        $fieldPlayerOne = self::buildField();
        $data['board_player_one'] = $this->board->create(['field' => json_encode($fieldPlayerOne)]);

        $fieldPlayerTwo = self::buildField();
        $data['board_player_two'] = $this->board->create(['field' => json_encode($fieldPlayerTwo)]);
        return $data;
    }

    /**
     * @return array
     */
    public static function buildField(): array
    {
        $board = [];
        for ($line = 0; $line < self::NUMBERLINES; $line++) {
            for ($column = 0; $column < self::NUMBERCOLUMNS; $column++ ){
//                $board[$line][$column] = "$line : $column";
                $board[$line][$column] = 00;
            }
        }
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

    /**
     * @param array $board
     * @return string
     */
    private static function showField(array $board): string
    {
        $prettyBoard = "";
        foreach ($board as $lines) {
            foreach ($lines as $column){
                $prettyBoard .= str_pad("[$column]", 5);
            }
            $prettyBoard .= "\n";
        }

        return $prettyBoard;
    }

    private function getIndexLetters(string $letter): int
    {
        return array_search(strtoupper($letter), $this->getLetters());
    }

    private function getIndexNumbers(int $number): int
    {
        return array_search($number, $this->getNumbers());
    }

    private function getLetters()
    {
        return range('A', 'J');
    }

    private function getNumbers()
    {
        return range(1, 10);
    }

    private function swapTwoVariables(&$x, &$y) {
        $x ^= $y ^= $x ^= $y;
    }
}
