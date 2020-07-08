<?php

namespace App\Services;

use Illuminate\Http\Request;

class GameService
{
    /**
     * Return string Win Or Lose .
     * @param $teamArr array
     *
     * @return string
     */
    public function gameProcess(array $teamArr):string
    {
        $rules = array(
                'team_a' => 'required|regex:/^[0-9,]+$/',
                'team_b'  => 'required|regex:/^[0-9,]+$/',
            );
        $validator = \Validator::make($teamArr, $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }
        try {
            $teamAArr = explode(',', $teamArr['team_a']);
            $teamBArr = explode(',', $teamArr['team_b']);
            $len = count($teamAArr);
            if ($this->checkGameResult($teamAArr, $teamBArr, $len)) {
                return "Win";
            }
            return "Lose";
        } catch (Exception $e) {
            return $this->exceptions->report($e);
        }
    }

    /**
     * To check result true or false.
     * @param teamA drain $teamA array
     * @param teamB drain $teamB array
     * @param len teamA array length $len int
     * @return bool
     */
    private function checkGameResult(array $teamA, array $teamB, int $len):bool
    {
        sort($teamA);
        sort($teamB);
        for ($i = 0; $i < $len; $i++) {
            if ($teamA[$i] <= $teamB[$i]) {
                return false;
            }
        }
        return true;
    }
}
