<?php


namespace App\Services;

use App\Helpers\NoticeMsg;
use App\Helpers\PublicHelper;
use Illuminate\Support\Carbon;
use App\Repositories\GameApiRepository;
use Illuminate\Support\Facades\DB;

class GameApiService
{
    protected $gameApiRepository, $publicHelper;

    public function __construct()
    {
        $this->gameApiRepository = new GameApiRepository();
        $this->publicHelper      = new PublicHelper();
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
//        dd($repository_res);
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

    public function gameGroup ()
    {
        $game_result = $this->gameApiRepository->game(false);
        $game_data = $game_result->toArray();
        $url_array = array();
        $result = array();
        foreach ($game_data as $key => $val)
        {
            $url_result = $this->gameApiRepository->lottery_url_by_gameid_and_enable($val['id'], 0);
            $url_data = $url_result->toArray();

            foreach ($url_data as $k => $v)
            {
                $url_array[$k]["id"] = $v["id"];
                $url_array[$k]["url"] = $v["url"];
                $url_array[$k]["api_name"] = $v["api_name"];
                $url_array[$k]["proxy_enable"] = $v["proxy_enable"];
            }
            $obj = array(
                "cname"     => $val["cname"],
                "ename"     => $val["ename"],
                "gameId"    => $val["id"],
                "param_2"   => json_encode($val["param_2"], true),
                "url"       => $url_array
            );
            array_push($result, $obj);
        }
        return $result;
    }

    public function openNumCheck ()
    {
        $data = $this->gameApiRepository->game(0)->toArray();
        $today= Carbon::now()->toDateString();
        $today .= ' 00:00:00';
        $Notice_count = 0;
        $today = "2000-01-01 00:00:00";
        foreach ($data as $key => $value)
        {
            $check_data = $this->gameApiRepository->periods_for_check($value['id'], 0, $today);

            foreach ($check_data as $k => $v)
            {
                $noticeTime = $value["noticeTime"];
                $rangeTime  = Carbon::parse("-".$noticeTime."seconds")->toDateTimeString();
                $beLotteryTime = $v["be_lottery_time"];

                $telegram_result = $this->gameApiRepository->telegram_by_group_web('1', 'N', 'TEST');

                if ($rangeTime > $beLotteryTime) {
                    $Notice_count++;

                    foreach ($telegram_result as $ID => $item)
                    {
                        $msg = $value["cname"]. " 第".$v["period_str"]."期，\n預計開獎時間為".$beLotteryTime;
                        $notice = array(
                            'noticeCode' => 'delayOpen',
                            'game_id'    => $value['id'],
                            'period_str' => $v['period_str'],
                            'user_id'    => $item['user_id'],
                            'msg'        => $msg
                        );
                        $this->publicHelper->noticeMsg($notice);
                    }
                }
            }
        }

        if ( !empty($data) ) {
            return $Notice_count;
        } else {
            return false;
        }
    }

    public function checkPeriod ()
    {
        $nowtime = Carbon::now();
        $tomorrow= Carbon::tomorrow();
        $week    = Carbon::tomorrow()->isoFormat('dddd');

        $data = $this->gameApiRepository->game_by_cycle('1', 'dayss');

        $Notice_count = 0;

        foreach ($data as $k => $v) {

        }
    }
}