<?php


namespace App\Services;

use Illuminate\Support\Carbon;
use App\Repositories\GameApiRepository;

class GameApiService
{
    protected $gameApiRepository;

    public function __construct()
    {
        $this->gameApiRepository = new GameApiRepository();
    }

    public function specify ($arr)
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

        $lottery_data = $this->gameApiRepository->lottery_data($periodS,$periodE,$game_id);

        return $lottery_data;
    }
}