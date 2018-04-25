<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('slug');
            $table->string('certificate')->nullable();
            $table->string('director')->nullable();
            $table->string('starring')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('runtime')->nullable();
            $table->text('description')->nullable();
            $table->string('thumb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
