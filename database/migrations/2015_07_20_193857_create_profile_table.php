<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('profiles', function(Blueprint $table)
      {
        $table->increments('id');
        $table->string('name');
        $table->string('handle');
        $table->string('image');
        $table->integer('current_price');
        $table->boolean('is_active')->default(false);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hashtag_price');
        Schema::drop('hashtags');
    }
}
