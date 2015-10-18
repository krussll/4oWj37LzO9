<?php
namespace App\Repositories;

use DB;
use App\League;
use App\Portfolio;
use Carbon\Carbon;
use App\Repositories\Interfaces\LeaguesRepositoryInterface as LeaguesRepositoryInterface;

class LeaguesRepository implements LeaguesRepositoryInterface
{
    public function GetLeagueById($id)
    {
        return League::find($id);
    }

	public function GetDefaultLeagues()
	{
		return League::where('is_default', true)->get();
	}

	public function CreateLeague($name, $initial_balance, $userId)
	{
		$league = League::create([
            'name' => $name,
            'code' => 'aaaaa',
            'initial_balance' => $initial_balance,
            'start_at' => Carbon::now(),
            'end_at' => null,
            'user_id' => $userId
        ]);

        $randomString = rand(1000, 9999);
        $league->code = $randomString . $league->id;
        $league->user_id = $userId;
        $league->save();
        $this->AddUserToLeague($userId, $league->id, $league->initial_balance);

        return $league->id;
	}

    public function GetLeaguePositions($leagueId)
    {
        $a = DB::table('portfolios')
        ->join('users', 'users.id', '=', 'portfolios.user_id')
        ->where('portfolios.league_id', $leagueId)
        ->select('users.surname', 'users.firstname', 'portfolios.balance', 'users.id')
        ->orderBy('portfolios.balance', 'desc')->get();

        $sql = "SELECT u.surname, u.firstname, u.id as id, p.balance as balance FROM portfolios p
                LEFT JOIN users u ON u.id = p.user_id
                LEFT JOIN trades t ON t.portfolio_id = p.id AND t.is_active = 1
                WHERE
                p.league_id = " . $leagueId . "
                GROUP BY u.id
                ORDER BY balance DESC";
        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function AddUserToGlobalLeagues($userId)
    {
    	foreach($this->GetDefaultLeagues() as $league)
    	{
    		$this->AddUserToLeague($userId, $league->id, $league->initial_balance);
    	}
    }

    public function AddUserToLeague($userId, $leagueId, $initial_balance)
    {
    	Portfolio::create([
            'user_id' => $userId,
            'league_id' => $leagueId,
            'balance' => $initial_balance,
            'is_active' => true
        ]);
    }

    public function GetUserGlobalPosition($id)
    {
        $positions = array();
        foreach(DB::table('portfolios')->join('leagues', 'leagues.id', '=', 'portfolios.league_id')->where('portfolios.user_id', $id)->where('leagues.is_global', true)->select('portfolios.league_id', 'portfolios.user_id', 'leagues.name')->get() as $portfolio)
        {
            $rank = $this->GetLeaguePosition($portfolio->user_id, $portfolio->league_id);
            $positions[] = array('name' => $portfolio->name, 'position' => $rank, 'id' => $portfolio->league_id);
        }
        return $positions;
    }

    public function GetUserPrivatePosition($id)
    {
        $positions = array();
        foreach(DB::table('portfolios')->join('leagues', 'leagues.id', '=', 'portfolios.league_id')->where('portfolios.user_id', $id)->where('leagues.is_global', false)->select('portfolios.league_id', 'portfolios.user_id', 'leagues.name')->get() as $portfolio)
        {
            $rank = $this->GetLeaguePosition($portfolio->user_id, $portfolio->league_id);
            $positions[] = array('name' => $portfolio->name, 'position' => $rank, 'id' => $portfolio->league_id);
        }
        return $positions;
    }

    public function GetLeaguePosition($userId, $leagueId)
    {
        $position = 1;

        foreach($this->GetLeaguePositions($leagueId) as $leaguePosition)
        {
          if($leaguePosition->id == $userId)
          {
            break;
          }
          $position++;
        }

        return $position;
    }

    public function GetLeagueByCode($code)
    {
        return League::where('code', $code)->first();
    }
}
