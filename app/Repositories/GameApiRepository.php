<?php


namespace App\Repositories;
use App\Models\LT_history;
use App\Models\LT_periods;
use App\Models\LT_url;

class GameApiRepository
{
    protected $lt_periods, $lt_history, $lt_url;

    public function __construct()
    {
        $this->lt_periods = new LT_periods();
        $this->lt_history = new LT_history();
        $this->lt_url     = new LT_url();
    }

    public function lottery_data($periodS, $periodE, $gameid)
    {
        return $this->lt_periods->whereRaw('be_lottery_time BETWEEN ? AND ?', array($periodS, $periodE))
            ->where('game_id', $gameid)
            ->where('lottery_status', '1')
            ->orderBy('period_str', 'DESC')
            ->get();
    }

    public function lottery_history($gameid, $period_str)
    {
        return $this->lt_history
                ->where('game_id', $gameid)
                ->where('period_str', $period_str)
                ->orderBy('lottery_time')
                ->get();
    }

    public function lottery_url_by_id($id)
    {
        return $this->lt_url
                ->where('id', $id)
                ->get();
    }
}