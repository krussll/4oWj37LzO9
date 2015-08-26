<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class HashtagClearup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hashtag:clearup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $results = DB::update( DB::raw("DELETE FROM tagqueue WHERE is_processed = 1"));
        $results = DB::update( DB::raw("DELETE FROM hashtag_count WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 7 DAY)"));
    }
}
