<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_current_prices', function(Blueprint $table)
        {
          $table->integer('price');
          $table->integer('profile_id')->unsigned();
          $table->timestamps();
          $table->foreign('profile_id')->references('id')->on('profiles');
        });

        Schema::create('profile_history_prices', function(Blueprint $table)
        {
          $table->integer('price');
          $table->integer('profile_id')->unsigned();
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

    }
}
