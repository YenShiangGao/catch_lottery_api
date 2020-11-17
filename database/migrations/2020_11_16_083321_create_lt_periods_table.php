<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_periods', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->integer('it_error_id');
            $table->string('lottery');
            $table->date('period_date');
            $table->integer('period_num');
            $table->string('period_str');
            $table->dateTime('lottery_time');
            $table->dateTime('be_lottery_time');
            $table->boolean('lottery_status');
            $table->boolean('checks');
            $table->integer('url_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_periods');
    }
}
