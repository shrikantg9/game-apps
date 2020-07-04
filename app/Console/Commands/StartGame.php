<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GameController;
use Illuminate\Validation\Validator;

class StartGame extends Command
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        $game= new GameController;
        $this->info("Please Enter all the players data comma separated. Example
        Enter A Teams players:
        30,100,20,50,40");
        $teamA = $this->ask('Enter A Teams players');
        $teamB = $this->ask('Enter B Teams players');
        $result = $game->gameProcess($teamA, $teamB);
        $this->info("Teams Players Drain");
        $this->info("Team A: [$teamA]");
        $this->info("Team B: [$teamB]");
        $this->info("Teams A");
        $this->info("$result");
    }
}
