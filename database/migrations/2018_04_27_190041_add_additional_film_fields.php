<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFilmFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('films', function (Blueprint $table) {
        $table->string('subtitle')->nullable();
        $table->string('year')->nullable();
        $table->string('association')->nullable();
        $table->string('format')->nullable();
        $table->text('tickets')->nullable();
        $table->string('f_rating')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
