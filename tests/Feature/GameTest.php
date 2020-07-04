<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\GameController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
    /**
     * testProcessGame feature test.
     *
     * @return void
     */
    public function testProcessGame()
    {
        $game=new GameController;
        $teamA="40,20,35,50,100";
        $teamB="35,10,30,20,90";
        $this->assertEquals('Win', $game->gameProcess($teamA, $teamB));
    }
}
