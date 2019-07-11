<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderFieldToCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('tags', function (Blueprint $table) {
        $table->text('order')->default('screening');
      });
      Schema::table('strands', function (Blueprint $table) {
        $table->text('order')->default('screening');
      });
      Schema::table('seasons', function (Blueprint $table) {
        $table->text('order')->default('screening');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collections', function (Blueprint $table) {
            //
        });
    }
}
