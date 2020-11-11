<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('functions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('code_name');
          $table->bigInteger('created_by')->unsigned()->index();
          $table->bigInteger('updated_by')->unsigned()->index();
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
        Schema::dropIfExists('functions');
    }
}
