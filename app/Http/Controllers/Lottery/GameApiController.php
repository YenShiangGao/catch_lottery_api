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
        $this->gameApiService = App::make('GameApiService');
    }

    public function specify(Request $request)
    {
        $input_arr = $request->toArray();
        $result = $this->gameApiService->specify($input_arr);

        return $this->message($result);
    }
}
