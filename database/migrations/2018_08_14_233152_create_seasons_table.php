<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('seasons', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->string('title');
          $table->string('thumb')->nullable();
          $table->text('short_description')->nullable();
          $table->text('description')->nullable();
          $table->string('order')->default('film');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
