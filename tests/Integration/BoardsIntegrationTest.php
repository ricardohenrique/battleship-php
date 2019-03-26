<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardsIntegrationTest extends TestCase
{
    public function testGetAllBoards()
    {
        $response = $this->get('/api/boards');
        $response->assertStatus(200);
    }
}
