<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameCommandTest extends TestCase
{
    /**
     * To test Command game:start.
     *
     * @return void
     */
    public function testGameCommand()
    {
        $this->artisan('game:start')
        ->expectsOutput('Please Enter all the players data comma separated. Example
        Enter A Teams players:
        30,100,20,50,40')
        ->expectsQuestion('Enter A Teams players', '40,20,35,50,100')
        ->expectsQuestion('Enter B Teams players', '35,10,30,20,90')
        ->expectsOutput('Teams Players Drain')
        ->expectsOutput('Team A: [40,20,35,50,100]')
        ->expectsOutput('Team B: [35,10,30,20,90]')
        ->expectsOutput('Teams A')
        ->expectsOutput('Win')
        ->assertExitCode(0);
    }
}
