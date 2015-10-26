<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('ALTER TABLE profile_current_prices MODIFY COLUMN price DECIMAL(8,2)');
      DB::statement('ALTER TABLE profile_history_prices MODIFY COLUMN price DECIMAL(8,2)');
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
