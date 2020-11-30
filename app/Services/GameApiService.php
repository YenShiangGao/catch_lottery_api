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
        //取需要參數
        $game_id    = $arr['gameid'];
        $period_str = $arr['period_str'];

        //撈取樂透歷史資料
        $history_data = $this->gameApiRepository->lottery_history($game_id, $period_str);

        //將資料轉換成array
        $temp = $history_data->toArray();

        $history_data = null;
        $url_repos = null;
        foreach ($temp[0] as $key => $value)
        {
            $history_data[$key] = $value;
        }

        //撈取url和網址名稱
        $url_repos = $this->gameApiRepository->lottery_url_by_id($history_data['url_id']);
        $url_data_array  = $url_repos->toArray();
        foreach ($url_data_array[0] as $key => $value)
        {
            $url_data[$key] = $value;
        }

        //轉成需要的資料格式
        //lottery_info
        $lottery_info = [
            'code'   => $history_data['lottery'],
            'source' => $url_data['url_name'],
            'url'    => $url_data['url'],
            'rectime'=> $history_data['lottery_time']
        ];

        //GameTypeInfo
        $GameTypeInfo = [
            'game_id'       => $history_data['game_id'],
            'period_date'   => Carbon::parse($history_data['lottery_time'])->toDateString(),
            'periods'       => $history_data['period_str'],
            'time'          => $history_data['lottery_time'],
            'lottery_info'  => $lottery_info
        ];

        return $GameTypeInfo;
    }
}