<?php


namespace App\Helpers;


trait NoticeMsg
{
    public function noticeMsg()
    {
        $noticeParams = array('noticeCode', 'game_id', 'period_str', 'user_id', 'msg');

//        foreach ($noticeParams as $param) {
//            if (!isset($notice[$param]) || trim($notice[$param]) === '' ) {
//                return "Notice Message Parameter Lost";
//            }
//        }

        $temp = config('noticecode.code.deplayOpen');



        return $temp;
    }
}