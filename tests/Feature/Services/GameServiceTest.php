<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use App\Services\GameService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameServiceTest extends TestCase
{
    /**
     * testProcessGame feature test.
     *
     * @return void
     */
    public function testgameProcess()
    {
        $gameService=new GameService;
        $this->assertEquals('Win', $gameService->gameProcess($this->teamDataProvider()));
    }

    /**
     * testProcessGame team Empty.
     *
     * @return void
     */
    public function testGameTeamDataIsEmpty()
    {
        $gameService=new GameService;
        $teamArr =[
            'team_a'=>'',
            'team_b'=>''
        ];
        $errorArr=[
            'team_a' => ['The team a field is required.'],
            'team_b' => ['The team b field is required.']
        ];
        $this->assertEquals(json_encode($errorArr), $gameService->gameProcess($teamArr));
    }

    /**
     * testProcessGame team Valid.
     *
     * @return void
     */
    public function testGameTeamDataIsValid()
    {
        $gameService=new GameService;
        $teamArr =[
            'team_a'=>'2,b',
            'team_b'=>'b,c'
        ];
        $errorArr=[
            'team_a' => ['The team a format is invalid.'],
            'team_b' => ['The team b format is invalid.']
        ];
        $this->assertEquals(json_encode($errorArr), $gameService->gameProcess($teamArr));
    }

    /**
     * Data provider for testgameProcess
     *
     * @return array
     */
    public function teamDataProvider() : array
    {
        return [
            'team_a'=>'40,20,35,50,100',
            'team_b'=>'35,10,30,20,90'
        ];
    }
}
