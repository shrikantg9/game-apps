<?php

namespace App\Console\Commands;

use App\Services\GameService;
use Illuminate\Console\Command;
use App\Service\GameHandleInterface;
use Illuminate\Validation\Validator;
use App\Http\Controllers\GameController;

class GameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will start the game';

    /**
    *
    * @var $gameHandle
    */
    protected $gameService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GameService $gameService)
    {
        parent::__construct();
        $this->gameService = $gameService;
    }

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        $this->info("Please Enter all the players data comma separated. Example
        Enter A Teams players:
        30,100,20,50,40");
        $teamA = $this->ask('Enter A Teams players');
        $teamB = $this->ask('Enter B Teams players');
        $teamArr = array(
            'team_a' => $teamA,
            'team_b' => $teamB
        );
        $result = $this->gameService->gameProcess($teamArr);
        $this->info("Teams Players Drain");
        $this->info("Team A: [$teamA]");
        $this->info("Team B: [$teamB]");
        $this->info("Teams A");
        $this->info("$result");
    }
}
