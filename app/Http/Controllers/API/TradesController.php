<?php

namespace App\Http\Controllers\API;

use Input;
use Auth;
use App\Trade;
use App\Hashtag;
use App\Portfolio;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\TradesRepository as TradesRepository;
use App\Repositories\UsersRepository as UsersRepository;
use App\Repositories\PortfoliosRepository as PortfoliosRepository;

class TradesController extends BaseController
{
    public function getTrades()
    {
        $rep = new TradesRepository();

        return response()->json($rep->GetAllTrades());
    }

    public function getActiveTrades()
    {
        $rep = new TradesRepository();

        $portfolio = Portfolio::find(Input::get('portfolio_id'));

        if ($portfolio == null)
        {
          return response()->json(array('success' => false, 'trades' => array()));
        }

        if ($portfolio->user_id == Auth::user()->id)
        {

            return response()->json(array('success' => true, 'trades' => $rep->GetTradesByPortfolioId($portfolio->id)));
        }

        return response()->json(array('success' => false, 'trades' => []));
    }

    public function CreateTrade()
    {
        $userRep = new UsersRepository();
        $portfolioRep = new PortfoliosRepository();
        $tradeRep = new TradesRepository();

        $user = Auth::user();
        $message = "";

        if ($user)
        {
            $profile = Profile::find(Input::get('profile_id'));
            $portfolio = Portfolio::find(Input::get('portfolio_id'));

            if ($portfolio->user_id == $user->id)
            {
                if($profile->current_price > 0)
                {
                    $sharestaken = Input::get('shares_taken');
                    $totalCost = Input::get('shares_taken') * $profile->current_price;

                    if($portfolio->balance >= $totalCost)
                    {
                      $trade = $tradeRep->GetActiveHashtagPortfolioTrade($profile->id, $portfolio->id);
                      if($trade !== null){
                        $trade->shares_taken = $trade->shares_taken + $sharestaken;
                        $trade->price_taken = $profile->current_price;
                      }else {
                        $trade = new Trade;
                        $trade->portfolio_id = $portfolio->id;
                        $trade->profile_id = $profile->id;
                        $trade->shares_taken = $sharestaken;
                        $trade->price_taken = $profile->current_price;
                        $trade->price_sold = 0;
                        $trade->is_active = 1;
                      }

                        $trade->save();

                        $portfolioRep->DecreaseBalance($portfolio, $totalCost);

                        return response()->json(array('success' => true, 'trade' => $trade));
                    }else
                    {
                        $message = "You can't afford this hashtag";
                    }
                }else
                {
                    $message = "The hashtag doesn't currently have a price";
                }
            }else
            {
                $message = "You don't have access to this portfolio";
            }
        }else
        {
            $message = "You're not currently logged in";
        }

        return response()->json(array('success' => false, 'message' => $message));
    }

    public function CompleteTrade()
    {
        $userRep = new UsersRepository();
        $portfolioRep = new PortfoliosRepository();
        $id = Input::get('id');

        $user = Auth::user();

        if ($user)
        {
            $trade = Trade::find($id);
            $portfolio = Portfolio::find($trade->portfolio_id);

            if ($portfolio->user_id == Auth::user()->id && $trade->is_active)
            {
               $profile = Profile::find($trade->profile_id);

                $trade->is_active = false;
                $trade->price_sold = $profile->current_price;

                $trade->save();
                $price = ($profile->current_price * $trade->shares_taken);
                $portfolioRep->IncreaseBalance($portfolio, $price);
                return response()->json(array('success' => true, 'portfolioId' => $portfolio->id, 'price' => $price));
            }
        }

        return response()->json(array('success' => false));
    }
}
