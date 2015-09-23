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
        $ignoredWords = array('job', 'jobs', 'hiring', 'careerarc');
        echo "starting";
        $results = DB::connection('pgsql')->select(DB::raw("SELECT LOWER(hashtag) as hashtag, COUNT(*) as count FROM  \"tagQueue\".\"tagQueue\" WHERE hashtag ~ E'[a-z0-9]' AND is_processed = B'0' AND created < now() GROUP BY hashtag HAVING COUNT(*) > 3",
                        array('now' => $now, 'min' => $min)));
echo "got new tags";
        $hashtags = [];
        foreach(Hashtag::where('is_archived', false)->get() as $hashtag)
        {
          if (!in_array($hashtag->tag, $ignoredWords))
          {
            $hashtags[$hashtag->tag] = $hashtag->id;
          }
        }

        $newhashtags = [];
        foreach($results as $tag)
        {
            if (!array_key_exists($tag->hashtag,$hashtags))
            {
                $model = new Hashtag;

                $model->tag = $tag->hashtag;

                if (!in_array($model->tag, $ignoredWords))
                {
                    $newhashtags[] = array('tag' => $tag->hashtag, 'current_price' => 1, 'is_active' => false, 'created_at' => $now, 'updated_at' => $now);
                }

            }
        }
echo "inserting new hashtags";
        Hashtag::insert($newhashtags);

        foreach(Hashtag::get() as $hashtag)
        {
            if (!array_key_exists($hashtag->hashtag,$hashtags))
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
echo "inserting counts";
        HashtagCount::insert($counts);

        $results = DB::connection('pgsql')->update( DB::raw("UPDATE \"tagQueue\".\"tagQueue\" SET is_processed = B'1' WHERE is_processed = B'0' AND created < ':now';",
            array('now' => $now)));


        $results = DB::connection('pgsql')->update( DB::raw("DELETE FROM \"tagQueue\".\"tagQueue\" WHERE is_processed = B'1'"));



    }
}
