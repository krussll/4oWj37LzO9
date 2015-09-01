<?php
namespace App\Repositories;

use DB;
use App\League;
use App\Portfolio;
use Carbon\Carbon;
use App\Repositories\Interfaces\LeaguesRepositoryInterface as LeaguesRepositoryInterface;

class LeaguesRepository implements LeaguesRepositoryInterface
{
	public function GetDefaultLeagues()
	{
		return League::where('is_default', true)->get();
	}

	public function CreateLeague($name, $initial_balance, $owner)
	{
		$league = League::create([
            'name' => $name,
            'code' => 'aaaaa',
            'initial_balance' => $initial_balance,
            'start_at' => Carbon::now(),
            'end_at' => null
        ]);

        $this->AddUserToLeague($owner, $league->id, $league->initial_balance);

        return $league->id;
	}

    public function GetLeaguePositions($leagueId)
    {
        return DB::table('portfolios')->join('users', 'users.id', '=', 'portfolios.user_id')->where('portfolios.league_id', $leagueId)->select('users.surname', 'users.firstname', 'portfolios.balance')->orderBy('portfolios.balance', 'desc')->get();
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
        foreach(DB::table('portfolios')->join('leagues', 'leagues.id', '=', 'portfolios.league_id')->where('user_id', $id)->where('leagues.is_global', true)->select('portfolios.league_id', 'portfolios.user_id', 'leagues.name')->get() as $portfolio)
        {
            $rank = $this->GetLeaguePosition($portfolio->user_id, $portfolio->league_id);
            $positions[] = array('name' => $portfolio->name, 'position' => $rank, 'id' => $portfolio->league_id);
        }
        return $positions;
    }

    public function GetUserPrivatePosition($id)
    {
        $positions = array();
        foreach(DB::table('portfolios')->join('leagues', 'leagues.id', '=', 'portfolios.league_id')->where('user_id', $id)->where('leagues.is_global', false)->select('portfolios.league_id', 'portfolios.user_id', 'leagues.name')->get() as $portfolio)
        {
            $rank = $this->GetLeaguePosition($portfolio->user_id, $portfolio->league_id);
            $positions[] = array('name' => $portfolio->name, 'position' => $rank, 'id' => $portfolio->league_id);
        }
        return $positions;
    }

    public function GetLeaguePosition($userId, $leagueId)
    {
        $sql = "SELECT `rank`
                    FROM
                    (
                      select @rownum:=@rownum+1 `rank`, p.* 
                      from portfolios p, (SELECT @rownum:=0) r 
                      WHERE league_id = " . $leagueId . "
                      order by balance DESC
                    ) s
                    WHERE user_id = " . $userId;
        $results = DB::select(DB::raw($sql));
        
        return $results[0]->rank;
    }

    public function GetLeagueByCode($code)
    {
        return League::where('code', $code)->first();
    }
}