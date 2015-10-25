<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Database\Schema\Blueprint;
use App\ProfilePrice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProfilePriceCommand extends Command
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
                DB::raw("SELECT
				  SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at DESC), ',', 1 ) as f,
                  (
                  	SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at DESC), ',', 1 ) -
                  	SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at), ',', 1 )
                  ) / SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at), ',', 1 ) as c,
                  SUBSTRING_INDEX( GROUP_CONCAT(CAST(tc.count AS CHAR) ORDER BY tc.created_at), ',', 1 ) as tc,
                  p.id as id

                  FROM profiles p
                  	LEFT JOIN follower_counts c ON p.id = c.profile_id AND c.created_at > DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                  	LEFT JOIN tweet_counts tc ON p.id = tc.profile_id AND tc.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                  	LEFT JOIN trades t ON p.id = t.profile_id AND t.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                  GROUP BY p.id"
                )
            );

        $divider = 1;

        $profiles = [];
        foreach($results as $profile_data)
        {
                $d = 1;
                $ec = 0.0005;
                $price = 1;

                $price = round((($profile_data->f / 1000) * (($profile_data->c - $ec) + 1)));

                $profiles[$profile_data->id] = $price;
        }

        foreach(array_chunk($profiles, 2000, true) as $chunk)
        {
          $inserts = [];
            foreach ($chunk as $id => $price)
            {
              echo $price . " - ";
                $inserts[] = array('price' => $price, 'profile_id' => $id, 'created_at' => new \DateTime, 'updated_at' => new \DateTime);
            }

            DB::table('profile_current_prices')->insert($inserts);
            DB::table('profile_history_prices')->insert($inserts);
        }
    }
}