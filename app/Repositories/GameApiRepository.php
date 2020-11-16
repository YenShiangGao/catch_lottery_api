<?php


namespace App\Repositories;
use App\Models\LT_periods;

class GameApiRepository
{
    protected $lt_periods;

    public function __construct()
    {
        $this->lt_periods = new LT_periods();
    }

    public function lottery_data($periodS, $periodE, $gameid)
    {
        return $this->lt_periods->whereRaw('be_lottory_time BETWEEN ? AND ?', array($periodS, $periodE))
            ->where('game_id', $gameid)
            ->where('lottery_status', '1')
            ->orderBy('period_str', 'DESC')
            ->get();
    }

}