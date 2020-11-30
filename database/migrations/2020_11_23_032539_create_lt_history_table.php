<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LT_history', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->integer('lottery_id');
            $table->string('period_str');
            $table->string('lottery');
            $table->dateTime('lottery_time');
            $table->integer('url_id');
            $table->string('proxy');
            $table->timestamps();
            $table->integer('code_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_history');
    }
}
