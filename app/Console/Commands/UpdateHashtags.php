<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Database\Schema\Blueprint;
use App\HashtagCount;
use App\HashtagPrice;
use App\Hashtag;
use App\PriceQueue;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateHashtags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hashtag:update';

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
        $results = PriceQueue::orderBy('created_at', 'desc')
               ->take(3000)
               ->get();

        print('got results');


        DB::transaction(function() use ($results)
        {
          $priceUpdates = [];
            foreach ($results as $price)
            {
              $priceUpdates[] = array('amount' => $price->price, 'hashtag_id' => $price->hashtag_id, 'created_at' => new \DateTime, 'updated_at' => new \DateTime);
            }
            DB::table('hashtag_price')->insert($priceUpdates);
        });

        print('hashtag_price done');

        $updateIds = "";
        $isFirst = true;

        foreach ($results as $price)
        {
          if($isFirst)
          {
            $isFirst = false;
            $updateIds .= $price->hashtag_id;
          }else {
            $updateIds .= ", " . $price->hashtag_id;
          }
        }

        DB::statement('call UpdatePrices("' . $updateIds . '");');

        print('chunk end');

        $results = PriceQueue::orderBy('created_at', 'desc')
               ->take(3000)
               ->delete();

        print('deleted chunk');

    }
}
