<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTelegramNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_telegram_notice', function (Blueprint $table) {
            $table->id();
            $table->char('tb_id',15);
            $table->integer('game_id');
            $table->char('period_str', 20);
            $table->char('type', 20);
            $table->integer('type_id');
            $table->char('user_id', 50);
            $table->text('content');
            $table->enum('notice', ['N', 'Y']);
            $table->dateTime('notice_time');
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
        Schema::dropIfExists('tb_telegram_notice');
    }
}
