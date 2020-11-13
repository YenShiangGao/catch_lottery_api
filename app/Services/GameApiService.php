<?php


namespace App\Services;

use Illuminate\Support\Carbon;

class GameApiService
{
    public function specify ($arr)
    {
        $periodS = $arr['periodS'];
        $periodE = $arr['periodE'];
        $game_id = $arr['gameid'];

        if ($periodS == NULL) {
           $periodS = Carbon::now();
        } else if ($periodE == NULL) {
            $periodE = Carbon::now();
        }

        return response()->json($arr,'200');
    }
}