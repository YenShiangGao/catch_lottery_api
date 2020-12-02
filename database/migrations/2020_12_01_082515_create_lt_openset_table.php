<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtOpensetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_openset', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->integer('lottery_year');
            $table->integer('lottery_month');
            $table->string('lottery_day');
            $table->boolean('enable', true);
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
        Schema::dropIfExists('lt_openset');
    }
}
