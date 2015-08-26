<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_price', function(Blueprint $table)
      {
        $table->increments('id');
        $table->integer('amount');
        $table->integer('hashtag_id')->unsigned();
        $table->timestamps();
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
        
    }
}
