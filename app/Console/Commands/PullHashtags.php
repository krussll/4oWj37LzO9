<?php

namespace App\Console\Commands;
use DB;
use App\Hashtag;
use App\HashtagCount;
use App\HashtagPrice;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;

class PullHashtags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hashtag:pull';

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
        $now = Carbon::now();
        $min = 1;
        
        $results = DB::connection('pgsql')->select(DB::raw("SELECT LOWER(hashtag) as hashtag, COUNT(*) as count FROM  \"tagQueue\".\"tagQueue\" WHERE hashtag NOT LIKE '%?%' AND is_processed = B'0' AND created < ':now' GROUP BY hashtag HAVING COUNT(*) > 1", 
                        array('now' => $now, 'min' => $min)));
        
        $hashtags = [];
        foreach(Hashtag::get() as $hashtag)
        {
            $hashtags[$hashtag->tag] = $hashtag->id;
        }

        $newhashtags = [];
        foreach($results as $tag)
        {
            if (!array_key_exists($tag->hashtag,$hashtags))
            {
                $model = new Hashtag;

                $model->tag = $tag->hashtag;

                
                $newhashtags[] = array('tag' => $tag->hashtag, 'created_at' => $now, 'updated_at' => $now);
            }
        }

        Hashtag::insert($newhashtags);

        foreach(Hashtag::get() as $hashtag)
        {
            if (!array_key_exists($tag->hashtag,$hashtags))
            {
               $hashtags[$hashtag->tag] = $hashtag->id; 
           }
        }

        $counts = [];

        foreach($results as $tag)
        {
            if (array_key_exists($tag->hashtag,$hashtags))
            {
                $counts[] = array('hashtag_id' => $hashtags[$tag->hashtag], 'count' => $tag->count, 'created_at' => $now, 'updated_at' => $now);
            }
        }

        HashtagCount::insert($counts);

        $results = DB::connection('pgsql')->update( DB::raw("UPDATE \"tagQueue\".\"tagQueue\" SET is_processed = B'1' WHERE is_processed = B'0' AND created < ':now';",
            array('now' => $now)));

        PriceHashtags();
        
        $results = DB::connection('pgsql')->update( DB::raw("DELETE FROM \"tagQueue\".\"tagQueue\" WHERE is_processed = B'1'"));
        $results = DB::update( DB::raw("DELETE FROM hashtag_count WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 7 DAY)"));
    }

    public function PriceHashtags()
    {        
        $results = DB::select(
                DB::raw("SELECT SUM(case when c.count > 0 then c.count else 0 end) as d, COUNT(c.id) as r, 
                SUM(case when t.is_active = true then 1 else 0 end) as b, SUM(case when t.is_active = false then 1 else 0 end) as s, h.id as id 
                FROM hashtags h  
                Left Join hashtag_count c ON h.id = c.hashtag_id AND c.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                LEFT JOIN trades t ON h.id = t.hashtag_id AND t.created_at > DATE_SUB(CURDATE(), INTERVAL 4 DAY)
                 GROUP BY h.id")
            );

        DB::transaction(function() use ($results)
        {
            $divider = 1;
            foreach ($results as $hashtag_data) 
            {
                $m = rand(10, 14) / 10;
                $price = 0;

                if ($hashtag_data->r > 0)
                {
                    $price = round(($hashtag_data->d / $hashtag_data->r) + ( (($hashtag_data->b - $hashtag_data->s) / $hashtag_data->r) * $m ));
                }
                
                DB::table('hashtags')->where('id', $hashtag_data->id)->update(array('current_price' => $price));
                DB::table('hashtag_price')->insert(['amount' => $price, 'hashtag_id' => $hashtag_data->id, 'created_at' => new \DateTime, 'updated_at' => new \DateTime]);
            }
        });
    }
}
