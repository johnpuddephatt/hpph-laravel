<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('programme')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->jsonb('address')->nullable();
            $table->text('access_info')->nullable();

            $table->string('order')->default('screening');

            $table->string('foreground_color')->nullable();
            $table->string('background_color')->nullable();

            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venues');
    }
}
