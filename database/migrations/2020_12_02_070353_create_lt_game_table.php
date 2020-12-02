<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_game', function (Blueprint $table) {
            $table->id();
            $table->string('cname');
            $table->string('ename');
            $table->boolean('enable');
            $table->string('cycle');
            $table->string('param');
            $table->date('param_1');
            $table->time('param_2');
            $table->char('repeat');
            $table->integer('urlCheck');
            $table->char('notice');
            $table->integer('noticeTime');
            $table->string('period_format');
            $table->integer('period_num');
            $table->integer('lottery_num');
            $table->integer('min_number');
            $table->integer('max_number');
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
        Schema::dropIfExists('lt_game');
    }
}
