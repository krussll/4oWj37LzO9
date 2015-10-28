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
echo "get data";
        $follower_results = DB::select(
                DB::raw("SELECT
				          SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at DESC), ',', 1 ) as f,
                  (
                  	SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at DESC), ',', 1 ) -
                  	SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at), ',', 1 )
                  ) / SUBSTRING_INDEX( GROUP_CONCAT(CAST(c.count AS CHAR) ORDER BY c.created_at), ',', 1 ) as c,
                  p.id as id

                  FROM profiles p
                  	LEFT JOIN follower_counts c ON p.id = c.profile_id AND c.created_at > DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                  GROUP BY p.id"
                )
            );

        $tweet_results = DB::select(
                DB::raw("SELECT
                  SUBSTRING_INDEX( GROUP_CONCAT(CAST(tc.count AS CHAR) ORDER BY tc.created_at DESC), ',', 1 ) -
                  SUBSTRING_INDEX( GROUP_CONCAT(CAST(tc.count AS CHAR) ORDER BY tc.created_at), ',', 1 ) as tc,
                  p.id as id

                  FROM profiles p
                  	LEFT JOIN tweet_counts tc ON p.id = tc.profile_id AND tc.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                  GROUP BY p.id"
                )
            );

        $trade_results = DB::select(
                DB::raw("SELECT
                  p.id as id

                  FROM profiles p
                  	LEFT JOIN trades t ON p.id = t.profile_id AND t.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                  GROUP BY p.id"
                )
            );
echo "got data";
        $divider = 1;
        $results = [];

        foreach($follower_results as $result)
        {
            $data = [];
            $data['id'] = $result->id;
            $data['f'] = $result->f;
            $data['c'] = $result->c;
            $data['tc'] = 0;

            $results[$result->id] = $data;
        }

        foreach($tweet_results as $result)
        {
            $data = $results[$result->id];
            $data['tc'] = $result->tc;

            $results[$result->id] = $data;
        }
echo "get prices";
        $profiles = [];
        foreach($results as $id => $result)
        {
          $profile_data = json_decode(json_encode($result,JSON_FORCE_OBJECT));

                $d = 1;
                $ec = 0.0005;
                $et = 0.004;
                $price = 0;

                $price = round((($profile_data->f / 1000000) * (((($profile_data->c - $ec) * 100) + (($profile_data->tc / 1000) - $et)) + 1)), 2);
                if ($price < 0.1)
                {
                  $price = 0.1;
                }

                $profiles[$profile_data->id] = $price;
        }
        echo "got prices";

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
