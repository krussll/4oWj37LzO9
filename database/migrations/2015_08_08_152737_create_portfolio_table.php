<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function(Blueprint $table)
      {
        $table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->integer('league_id')->unsigned();
        $table->integer('balance');
        $table->boolean('is_active');
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('league_id')->references('id')->on('leagues');
      });

        DB::table('portfolios')->insert(['user_id' => 1, 'league_id' => 1, 'balance' => 10700, 'is_active' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('portfolios');
    }
}
