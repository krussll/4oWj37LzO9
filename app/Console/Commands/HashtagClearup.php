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
        $results = DB::select(
                DB::raw("SELECT h.id FROM hashtags h
                    LEFT JOIN hashtag_price c ON c.hashtag_id = h.id AND c.created_at > DATE_SUB(CURDATE(), INTERVAL 2 DAY)
                     where current_price < 2
                     AND c.amount < 2
                     GROUP BY h.id")
            );


        DB::transaction(function() use ($results)
        {
            foreach($results as $result)
            {
                DB::update( DB::raw("UPDATE hashtags SET is_archived = true WHERE id = " . $result->id));
            }
        });

        $results = DB::update( DB::raw("DELETE FROM hashtag_count WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 7 DAY)"));
        $results = DB::update( DB::raw("DELETE FROM hashtag_price WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 7 DAY)"));
    }
}
