<?php

namespace App\Console\Commands;

use DB;
use Auth;
use App\Trade;
use App\Hashtag;
use App\Portfolio;
use Illuminate\Console\Command;
use App\Repositories\TradesRepository as TradesRepository;
use App\Repositories\UsersRepository as UsersRepository;
use App\Repositories\PortfoliosRepository as PortfoliosRepository;

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
                     where current_price < 11
                     AND c.amount < 11
                     GROUP BY h.id")
            );


        DB::transaction(function() use ($results)
        {
          $portfolioRep = new PortfoliosRepository();
          $tradesRep = new TradesRepository();
            foreach($results as $result)
            {
              foreach($tradesRep->GetActiveHashtagTrades($result->id) as $trade)
              {
                $hashtag = Hashtag::find($trade->hashtag_id);
                $portfolio = Portfolio::find($trade->portfolio_id);

                $trade->is_active = false;
                $trade->price_sold = $hashtag->current_price;

                $trade->save();
                $price = ($hashtag->current_price * $trade->shares_taken);
                $portfolioRep->IncreaseBalance($portfolio, $price);
              }
              DB::update( DB::raw("UPDATE hashtags SET is_archived = true WHERE id = " . $result->id));
            }
        });

        $results = DB::update( DB::raw("DELETE FROM hashtag_count WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 5 DAY)"));
        $results = DB::update( DB::raw("DELETE FROM hashtag_price WHERE created_at < DATE_SUB(CURDATE(), INTERVAL 5 DAY)"));
    }
}
