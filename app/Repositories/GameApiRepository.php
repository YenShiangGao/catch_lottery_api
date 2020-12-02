<?php


namespace App\Repositories;
use App\Models\LT_history;
use App\Models\LT_openset;
use App\Models\LT_period_error;
use App\Models\LT_periods;
use App\Models\LT_url;
use App\Models\LT_vac;
use Illuminate\Support\Facades\DB;

class GameApiRepository
{
    protected $lt_periods, $lt_history, $lt_url, $lt_period_error, $lt_openset, $lt_vac;

    public function __construct()
    {
        $this->lt_periods       = new LT_periods();
        $this->lt_history       = new LT_history();
        $this->lt_url           = new LT_url();
        $this->lt_period_error  = new LT_period_error();
        $this->lt_openset       = new LT_openset();
        $this->lt_vac           = new LT_vac();
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

    public function periodError_by_time($begin, $end)
    {
        return $this->lt_period_error
                ->whereBetween('created_at', [$begin,$end])
                ->get();
    }

    public function period_by_id($id)
    {
        return $this->lt_periods
                ->select('period_str')
                ->where('id', $id)
                ->first();
    }

    public function openset_by_year($game_id, $year)
    {
        return $this->lt_openset
                ->where('game_id', $game_id)
                ->where('lottery_year', $year)
                ->get();
    }

    public function openset_by_date($game_id, $year, $month)
    {
        return $this->lt_openset
            ->where('game_id', $game_id)
            ->where('lottery_year', $year)
            ->where('lottery_month', $month)
            ->get();
    }

    public function vac_data ($year = null, $game_id = null)
    {
       $sql = null;
       if ( $year != null ) {
           $sql .= " AND vacStart > '" . $year . "-01-01 00:00:00' AND vacEnd < '". $year . "-12-31 23:59:59'";
       }
       if ( $game_id != null ) {
           $sql .= "and game_id =" . $game_id;
       }

       return DB::select("select id, game_id, vacStart, vacEnd from LT_vac where 1=1". $sql);
    }
}