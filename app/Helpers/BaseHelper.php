<?php


namespace App\Helpers;


trait BaseHelper
{
    protected $noticeParams = array('noticeCode', 'game_id', 'period_str', 'user_id', 'msg');

    public function noticeMsg ($notice)
    {
        foreach ($this->noticeParams as $param)
        {
            if (!isset($notice[$param]) || trim($notice[$param]) === '') {
                $msg = "Nottice Message Parameter Lost";
            }
        }
    }
}