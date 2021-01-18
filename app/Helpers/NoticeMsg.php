<?php


namespace App\Helpers;
use App\Repositories\HelperRepository;

trait NoticeMsg
{
    protected $helperRepository;

    public function __construct()
    {
        $this->helperRepository = new HelperRepository();
    }

    public function noticeMsg($notice)
    {
        $noticeParams = array('noticeCode', 'game_id', 'period_str', 'user_id', 'msg');

        foreach ($noticeParams as $param) {
            if (!isset($notice[$param]) || trim($notice[$param]) === '' ) {
                return "Notice Message Parameter Lost";
            }
        }

        $temp = config('noticecode.code.deplayOpen');
        $type = $temp[1];
        $type_id = $temp[0];

        $result = $this->helperRepository->get_notice_id($notice['game_id'], $notice['period_str'], $type_id);
        if ($result == null) {
            $add = array(
                "game_id"    => $notice['game_id'],
                "period_str" => $notice['period_str'],
                "type"       => $type,
                "type_id"    => $type_id,
                "user_id"    => $notice['user_id'],
                "content"    => $type. "\n" . $notice['msg'],
                "notice"     => "N"
            );
            $this->helperRepository->add_notice($add);
        }

        return 0;
    }
}