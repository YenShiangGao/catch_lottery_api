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

    public function specifyPeriodErrorService($arr)
    {
        if ((!strtotime($arr['begin_date'])))
            return false;
        $end_date   = Carbon::parse($arr['end_date'])->toDateTimeString();
        $begin_date = Carbon::parse($arr['begin_date'])->toDateTimeString();

        $error_repository = $this->gameApiRepository->periodError_by_time($begin_date, $end_date);
        $error_data = $error_repository->toArray();

        foreach ($error_data as $key => $item)
        {
            $lottery_id = $this->gameApiRepository->period_by_id($item['lottery_id']);
            $error_data[$key]["period_str"] = $lottery_id['period_str'];
        }
        return $error_data;
    }

    public function openDateService ($arr)
    {
        $result = null;
        if ($arr["year"] === null) {
            $year = Carbon::now()->year;
        } else {
            $year = $arr['year'];
        }
        if ($arr['month'] === null) {
            $repository_res = $this->gameApiRepository->openset_by_year($arr['gameid'], $year)->toArray();
        } else {
            $repository_res = $this->gameApiRepository->openset_by_date($arr['gameid'], $year, $arr['month'])->toArray();
        }
        dd($repository_res);
        foreach ($repository_res as $key => $val)
        {
            $result[$key]["Lottery_year"]  = $val[$key]["lottery_year"];
            $result[$key]["Lottery_month"] = $val[$key]["lottery_month"];
            $result[$key]["Lottery_day"]   = $val[$key]["lottery_day"];
        }
        return $result;
    }

    public function vacList ($arr)
    {
        $year    = $arr['year'];
        $game_id = $arr['gameid'];

        $result = $this->gameApiRepository->vac_data($year, $game_id);

        return $result;
    }
}