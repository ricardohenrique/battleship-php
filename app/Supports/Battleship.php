<?php

namespace App\Supports;

trait Battleship
{
    /**
     * Number of columns on the board
     */
    public static $NUMBERCOLUMNS = 10;

    /**
     * Number of the lines on the board
     */
    public static $NUMBERLINES = 10;

    public static function buildField(): array
    {
        $board = [];
        for ($line = 0; $line < self::$NUMBERLINES; $line++) {
            for ($column = 0; $column < self::$NUMBERCOLUMNS; $column++ ){
                $board[$line][$column] = 0;
            }
        }
        return $board;
    }

    public static function showField(array $board): string
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

    public static function getIndexLetters(string $letter): int
    {
        return array_search(strtoupper($letter), self::getLetters());
    }

    public static function getIndexNumbers(int $number): int
    {
        return array_search($number, self::getNumbers());
    }

    public static function getLetters()
    {
        return range('A', 'J');
    }

    public static function getNumbers()
    {
        return range(1, 10);
    }
}
