<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GameApiService;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GameApiService', function () {
            return new GameApiService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
