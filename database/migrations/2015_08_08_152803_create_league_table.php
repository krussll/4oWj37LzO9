<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
      Schema::create('trades', function(Blueprint $table)
      {
        $table->increments('id');
        $table->integer('portfolio_id')->unsigned();
        $table->integer('hashtag_id')->unsigned();
        $table->integer('shares_taken');
        $table->integer('price_taken');
        $table->integer('price_sold');
        $table->boolean('is_active');
        $table->timestamps();
        $table->foreign('portfolio_id')->references('id')->on('portfolios');
        $table->foreign('hashtag_id')->references('id')->on('hashtags');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trades');
    }
}
