<?php


namespace App\Repositories;
use App\Models\tb_telegram_notice;
use Carbon\Carbon;

class HelperRepository
{
    protected $tb_telegram_notice;

    public function __construct()
    {
        $this->tb_telegram_notice = new tb_telegram_notice();
    }

    public function get_notice_id($game_id, $period_str, $type_id)
    {
        return $this->tb_telegram_notice
            ->where('game_id', $game_id)
            ->where('period_str', $period_str)
            ->where('type_id', $type_id)
            ->limit(1)
            ->get()
            ->toArray();
    }

    public function add_notice ($add)
    {
        $this->tb_telegram_notice->game_id = $add['game_id'];
        $this->tb_telegram_notice->tb_id = "";
        $this->tb_telegram_notice->period_str = $add['period_str'];
        $this->tb_telegram_notice->type = $add['type'];
        $this->tb_telegram_notice->type_id = $add['type_id'];
        $this->tb_telegram_notice->user_id = $add['user_id'];
        $this->tb_telegram_notice->content = $add['content'];
        $this->tb_telegram_notice->notice = $add['notice'];
        $this->tb_telegram_notice->notice_time = Carbon::now();
        $this->tb_telegram_notice->save();
    }
}