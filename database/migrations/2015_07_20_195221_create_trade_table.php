<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->integer('initial_balance');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_global')->default(false);
            $table->date('start_at');
            $table->date('end_at')->nullable();
            $table->timestamps();
        });

        DB::table('leagues')->insert(['name' => 'Overall', 'code' => '', 'initial_balance' => 10000, 'is_default' => true, 'is_global' => true, 'start_at' => new DateTime, 'end_at' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime]);
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::drop('portfolios');
        Schema::drop('leagues');
    }
}
