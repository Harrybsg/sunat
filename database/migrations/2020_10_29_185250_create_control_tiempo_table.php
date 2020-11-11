<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlTiempoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_tiempo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('activity');
            $table->bigInteger('function_id')->unsigned()->required();
            $table->bigInteger('user_id')->unsigned()->required();
            $table->date('start_date');
            $table->time('start_time',0);
            $table->time('trasnscurred_time',0);
            $table->time('finished_time',0);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('function_id')->references('id')->on('functions');
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
        Schema::dropIfExists('control_tiempo');
    }
}
