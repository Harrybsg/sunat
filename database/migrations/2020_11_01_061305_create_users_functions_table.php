<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_functions', function (Blueprint $table) {
          $table->bigInteger('user_id')->unsigned()->required();
          $table->bigInteger('function_id')->unsigned()->required();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('function_id')->references('id')->on('functions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_functions');
    }
}
