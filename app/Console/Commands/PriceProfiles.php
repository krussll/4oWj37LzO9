<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Database\Schema\Blueprint;
use App\ProfilePrice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PriceProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:price';

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
        $results = DB::select(
                DB::raw("SELECT SUM(case when c.count > 0 then c.count else 0 end) / COUNT(c.created_at) as d,
SUM(case when tc.count > 0 then tc.count else 0 end) / COUNT(tc.created_at) as tc,
SUM(case when t.is_active = true then 1 else 0 end) as b,
SUM(case when t.is_active = false then 1 else 0 end) as s,
p.id as id

                  FROM profiles p
                  Left Join follower_counts c ON p.id = c.profile_id AND c.created_at > DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                  Left Join tweet_counts tc ON p.id = tc.profile_id AND tc.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                  LEFT JOIN trades t ON p.id = t.profile_id AND t.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                   GROUP BY p.id"
                )
            );

        $divider = 1;

        $profiles = [];
        foreach($results as $profile_data)
        {
                $d = 1000;
                $q = 0;
                $price = 1;

                $price = round((($profile_data->tc) + ($profile_data->d)) / $d);


                $profiles[$profile_data->id] = $price;
        }

        foreach(array_chunk($profiles, 2000, true) as $chunk)
        {
          $inserts = [];
            foreach ($chunk as $id => $price)
            {
                $inserts[] = array('price' => $price, 'profile_id' => $id, 'created_at' => new \DateTime, 'updated_at' => new \DateTime);
            }

            DB::table('profile_current_prices')->insert($inserts);
            DB::table('profile_history_prices')->insert($inserts);
        }
    }
}
