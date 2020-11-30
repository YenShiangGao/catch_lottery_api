<?php


namespace App\Services;

use Illuminate\Support\Carbon;
use App\Repositories\GameApiRepository;
use App\Helpers\ApiResponse;

class GameApiService
{
    protected $gameApiRepository;

    public function __construct()
    {
        $this->gameApiRepository = new GameApiRepository();
    }

    public function specifyGame($arr)
    {
        $periodS = $arr['periodS'];
        $periodE = $arr['periodE'];
        $game_id = $arr['gameid'];

        if ($periodS == NULL) {
            $periodS = Carbon::now();
        } else {
            $periodS = Carbon::parse($periodS)->toDateTimeString();
        }
        if ($periodE == NULL) {
            $periodE = Carbon::now();
        } else {
            $periodE = Carbon::parse($periodE)->toDateTimeString();
        }

        $lottery_data = $this->gameApiRepository->lottery_data($periodS, $periodE, $game_id);


        return $lottery_data;
    }

    public function specifyPeriod($arr)
    {
        $game_id    = $arr['gameid'];
        $period_str = $arr['period_str'];

        $history_data = $this->gameApiRepository->lottery_history($game_id, $period_str);

        $temp = $history_data->toArray();
        $history_data = null;
        foreach ($temp[0] as $key => $value)
        {
            $history_data[$key] = $value;

        }
    }
}