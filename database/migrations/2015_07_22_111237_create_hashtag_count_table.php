<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_count', function(Blueprint $table)
      {
        $table->increments('id');
        $table->integer('hashtag_id')->unsigned();
        $table->integer('count');
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
        Schema::drop('hashtag_count');
        //
    }
}
