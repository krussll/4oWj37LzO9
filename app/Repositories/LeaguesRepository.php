<?php
namespace App\Repositories;

use DB;
use App\League;
use App\Portfolio;
use App\Repositories\Interfaces\LeaguesRepositoryInterface as LeaguesRepositoryInterface;

class LeaguesRepository implements LeaguesRepositoryInterface
{
	public function GetDefaultLeagues()
	{
		return League::where('is_default', true)->get();
	}

	public function CreateLeague($name, $initial_balance)
	{
		$league = League::create([
            'name' => Input::get('name'),
            'code' => Input::get('name'),
            'initial_balance' => 10000,
            'start_at' => Carbon::now(),
            'end_at' => null
        ]);

        $this->AddUserToLeague($Auth::user()->id, $league->id, $league->initial_balance);
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
}