<?php


namespace App\Repositories;
use App\Models\LT_game;
use App\Models\LT_history;
use App\Models\LT_openset;
use App\Models\LT_period_error;
use App\Models\LT_periods;
use App\Models\LT_url;
use App\Models\LT_vac;
use App\Models\tb_telegram_user;
use Illuminate\Support\Facades\DB;

class GameApiRepository
{
    protected $lt_periods, $lt_history, $lt_url, $lt_period_error, $lt_openset, $lt_vac, $lt_game, $tb_telegram_user;

    public function __construct()
    {
        $this->lt_periods       = new LT_periods();
        $this->lt_history       = new LT_history();
        $this->lt_url           = new LT_url();
        $this->lt_period_error  = new LT_period_error();
        $this->lt_openset       = new LT_openset();
        $this->lt_vac           = new LT_vac();
        $this->lt_game          = new LT_game();
        $this->tb_telegram_user = new tb_telegram_user();
    }

    /**
         *LT_periods相關eloqent處理函式
         */
    public function lottery_data($periodS, $periodE, $gameid)
    {
        return $this->lt_periods
            ->whereRaw('be_lottery_time BETWEEN ? AND ?', array($periodS, $periodE))
            ->where('game_id', $gameid)
            ->where('lottery_status', '1')
            ->orderBy('period_str', 'DESC')
            ->get();
    }

    public function periods_for_check($game_id, $status, $today)
    {
        return $this->lt_periods
                ->where('game_id', $game_id)
                ->where('lottery_status', $status)
                ->where('be_lottery_time','>=', $today)
                ->get()
                ->toArray();
    }

    public function period_by_id($id)
    {
        return $this->lt_periods
            ->select('period_str')
            ->where('id', $id)
            ->first();
    }

    /**
         *LT_history相關eloqent處理函式
         */
    public function lottery_history($gameid, $period_str)
    {
        return $this->lt_history
                ->where('game_id', $gameid)
                ->where('period_str', $period_str)
                ->orderBy('lottery_time')
                ->get();
    }

    /**
         * LT_url 相關eloqent處理函式
         */
    public function lottery_url_by_id($id)
    {
        return $this->lt_url
                ->where('id', $id)
                ->get();
    }

    public function lottery_url_by_gameid_and_enable($game_id, $enable)
    {
        return $this->lt_url
                ->where('game_id', $game_id)
                ->where('enable', $enable)
                ->get();
    }

    /**
         *   LT_period_by_time 相關eloqent處理函式
        */
    public function periodError_by_time($begin, $end)
    {
        return $this->lt_period_error
                ->whereBetween('created_at', [$begin,$end])
                ->get();
    }

    /**
         *LT_openset 相關eloqent處理函式
         */
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

    /**
         *LT_vac 相關eloqent處理函式
         */
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


    /**
         *  LT_game相關eloquent 處理
         */
    public function game($enable)
    {
        return $this->lt_game
                ->where('enable', $enable)
                ->get();
    }

    public function game_by_cycle($enable, $cycle)
    {
        return $this->lt_game
            ->where('enable', $enable)
            ->where('cycle', $cycle)
            ->get();
    }

    /**
         * tb_telegram_user相關eloquent 處理
        */
    public function telegram_by_group_web ($group_id, $enable, $web)
    {
        return $this->tb_telegram_user
                ->where('group_id', $group_id)
                ->where('enable',   $enable)
                ->where('web', $web)
                ->get()
                ->toArray();
    }
}