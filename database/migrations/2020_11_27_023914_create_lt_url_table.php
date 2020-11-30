<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLtUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_url', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->string('url');
            $table->string('url_name');
            $table->string('api_name');
            $table->char('post');
            $table->boolean('enable');
            $table->boolean('code_order');
            $table->string('last_period');
            $table->boolean('last_status');
            $table->integer('last_proxy');
            $table->boolean('proxy_enable');
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
        Schema::dropIfExists('lt_url');
    }
}
