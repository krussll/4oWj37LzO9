<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('ALTER TABLE trades MODIFY COLUMN price_taken DECIMAL(8,2)');
      DB::statement('ALTER TABLE trades MODIFY COLUMN price_sold DECIMAL(8,2)');
      DB::statement('ALTER TABLE portfolios MODIFY COLUMN balance DECIMAL(8,2)');
      DB::statement('ALTER TABLE leagues MODIFY COLUMN initial_balance DECIMAL(8,2)');
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
