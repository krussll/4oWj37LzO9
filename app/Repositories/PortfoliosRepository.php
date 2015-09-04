<?php
namespace App\Repositories;

use DB;
use App\Portfolio;
use App\Repositories\Interfaces\ PortfoliosRepositoryInterface as PortfoliosRepositoryInterface;

class PortfoliosRepository implements PortfoliosRepositoryInterface
{
	
	public function DecreaseBalance($portfolio, $amount)
	{
		$portfolio->balance = $portfolio->balance - $amount;
		$portfolio->save();
	}

	public function IncreaseBalance($portfolio, $amount)
	{
		$portfolio->balance = $portfolio->balance + $amount;
		$portfolio->save();
	}

	public function GetByUserId($userId)
	{
		return DB::table('portfolios')
					->select(array('portfolios.id', 'leagues.name', 'portfolios.balance'))
                    ->leftJoin('leagues', 'leagues.id', '=', 'portfolios.league_id')
                    ->where('portfolios.user_id', $userId)->get();
	}

	public function DoesLeaguePortfolioExist($userId, $leagueId)
	{
		return (Portfolio::where('user_id', $userId)->where('league_id', $leagueId)->first() !== null);
	}
}