<?php

namespace App\Http\Controllers\Lottery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class GameApiController extends Controller
{
    protected $gameApiService;

    public function __construct()
    {
        //特過ServiceProvider 進行呼叫
        $this->gameApiService = App::make('GameApiService');
    }

    public function specifyGame(Request $request)
    {
        $input_arr = $request->toArray();
        $result = $this->gameApiService->specifyGame($input_arr);

        //自訂義response
        if (!$result) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function specifyPeriod(Request $request)
    {
        $arr = $request->toArray();
        $result = $this->gameApiService->specifyPeriod($arr);

        //自訂義response
        if (!$result) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function specifyPeriodError(Request $request)
    {
        $arr = $request->toArray();

        $result = $this->gameApiService->specifyPeriodErrorService($arr);

        //自訂義response
        if (!$result || $result == null) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function openDate (Request $request)
    {
        $arr = $request->toArray();

        $result = $this->gameApiService->openDateService($arr);

        //自訂義response
        if (!$result || $result == null) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function vacList (Request $request)
    {
        $arr = $request->toArray();

        $result = $this->gameApiService->vacList($arr);

        //自訂義response
        if (!$result || $result == null) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function gameGroup ()
    {
        $result = $this->gameApiService->gameGroup();

        //自訂義response
        if (!$result || $result == null) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function openNumCheck ()
    {
        $result = $this->gameApiService->openNumCheck();

        //自訂義response
        if (!$result || $result == null) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }

    public function checkPeriods ()
    {
        $result = $this->gameApiService->checkPeriod();

        //自訂義response
        if (!$result || $result == null) {
            return $this->notFond();
        } else {
            return $this->message($result);
        }
    }
}
