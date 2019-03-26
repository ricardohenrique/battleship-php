<?php

namespace Tests\Unit;

use App\Models\Board;
use App\Services\ServiceBoard;
use App\Services\ServiceShip;
use Mockery;
use Tests\TestCase;

class BoardsUnitTest extends TestCase
{
    public function testGetAllBoards()
    {
        $boardModelMock = Mockery::mock(Board::class);
        $serviceShipMock = Mockery::mock(ServiceShip::class);

        $defaultBoard = factory(Board::class)->create();

        $boardModelMock->allows([
            "all" => [$defaultBoard],
        ]);

        $service = new ServiceBoard($boardModelMock, $serviceShipMock);
        $this->assertEquals([$defaultBoard], $service->getAll());
    }
}
