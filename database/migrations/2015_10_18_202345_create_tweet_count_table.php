<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tweet_counts', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('profile_id')->unsigned();
      $table->integer('count');
      $table->timestamps();
      $table->foreign('profile_id')->references('id')->on('profiles');
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
