<?php
namespace App\Repositories;

use DB;
use App\Trade;
use App\User;
use App\Repositories\Interfaces\TradesRepositoryInterface as TradesRepositoryInterface;

class TradesRepository implements TradesRepositoryInterface
{
	public function GetAllTrades()
	{
		return Trade::with('hashtag')->get();
	}

	public function GetTradesByPortfolioId($id)
	{

		return Trade::with('hashtag')->where('portfolio_id', $id)->where('is_active', true)->get();
	}

	public function GetActiveHashtagPortfolioTrade($hashtagId, $portfolioId)
	{
		return Trade::where('hashtag_id', $hashtagId)->where('portfolio_id', $portfolioId)->where('is_active', true)->first();
	}

	public function GetActiveHashtagTrades($hashtagId)
	{
		return Trade::where('hashtag_id', $hashtagId)->where('is_active', true)->get();
	}
}
