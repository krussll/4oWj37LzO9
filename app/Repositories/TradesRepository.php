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
		return Trade::with('profile')->get();
	}

	public function GetTradesByPortfolioId($id)
	{

		return Trade::with('profile')->where('portfolio_id', $id)->where('is_active', true)->get();
	}

	public function GetActiveHashtagPortfolioTrade($profile_id, $portfolioId)
	{
		return Trade::where('profile_id', $profile_id)->where('portfolio_id', $portfolioId)->where('is_active', true)->first();
	}

	public function GetActiveHashtagTrades($profile_id)
	{
		return Trade::where('profile_id', $profile_id)->where('is_active', true)->get();
	}
}
