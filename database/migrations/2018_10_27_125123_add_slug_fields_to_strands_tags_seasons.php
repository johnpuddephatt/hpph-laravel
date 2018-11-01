<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugFieldsToStrandsTagsSeasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('strands', function (Blueprint $table) {
        $table->text('slug')->nullable();
      });
      Schema::table('tags', function (Blueprint $table) {
        $table->text('slug')->nullable();
      });
      Schema::table('seasons', function (Blueprint $table) {
        $table->text('slug')->nullable();
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
