<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Database\Schema\Blueprint;
use App\HashtagCount;
use App\HashtagPrice;
use App\Hashtag;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PriceHashtags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hashtag:price';

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

        print('getting results');
        $results = DB::select(
                DB::raw("SELECT SUM(case when c.count > 0 then c.count else 0 end) as d, COUNT(c.id) as r, 
                SUM(case when t.is_active = true then 1 else 0 end) as b, SUM(case when t.is_active = false then 1 else 0 end) as s, h.id as id 
                FROM hashtags h  
                Left Join hashtag_count c ON h.id = c.hashtag_id AND c.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                LEFT JOIN trades t ON h.id = t.hashtag_id AND t.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                 GROUP BY h.id")
            );

        print('got results');
        
        $divider = 1;
        
        print('start pricing');
        $hashtags = [];
        foreach($results as $hashtag_data)
        {
                $m = rand(10, 14) / 10;
                $price = 0;

                if ($hashtag_data->r > 0)
                {
                    $price = round(($hashtag_data->d / $hashtag_data->r) + ( (($hashtag_data->b - $hashtag_data->s) / $hashtag_data->r) * $m ));
                }

                $hashtags[$hashtag_data->id] = $price;
        }




        print('insert chunk start');
        DB::transaction(function() use ($hashtags)
        {
            foreach ($hashtags as $id => $price) 
            {
                DB::table('hashtag_price')->insert(['amount' => $price, 'hashtag_id' => $id, 'created_at' => new \DateTime, 'updated_at' => new \DateTime]);
                DB::update( DB::raw("UPDATE hashtags SET current_price = " . $price . " WHERE id = " . $id));
            }
        });
        print('chunk end');


    }
}
