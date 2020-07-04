<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Return string Win Or Lose .
     * @param teamA drain $teamA string
     * @param teamB drain $teamB string
     * @return string
     */
    public function gameProcess(string $teamA, string $teamB):string
    {
        $data = array(
                'team_a' => $teamA,
                'team_b' => $teamB
            );
        $rules = array(
                'team_a' => 'required|regex:/^[0-9,]+$/',
                'team_b'  => 'required|regex:/^[0-9,]+$/',
            );
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }
        try {
            $teamAArr = explode(',', $teamA);
            $teamBArr = explode(',', $teamB);
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
