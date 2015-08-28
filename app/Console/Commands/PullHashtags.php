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
        
        $results = DB::connection('pgsql')->select(DB::raw("SELECT LOWER(hashtag) as hashtag, COUNT(*) as count FROM tagqueue WHERE hashtag NOT LIKE '%?%' AND is_processed = 0 AND created < ':now' GROUP BY hashtag HAVING COUNT(*) > 1", 
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
        $results = DB::connection('pgsql')->table('tagqueue')->where('is_processed' , false)->where('created', '<', $now)->update(array('is_processed' => true));
        
        
    }
}
