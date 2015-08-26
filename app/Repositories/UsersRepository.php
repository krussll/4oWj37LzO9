<?php
namespace App\Repositories;

use DB;
use App\User;
use App\Repositories\Interfaces\ UsersRepositoryInterface as UsersRepositoryInterface;

class UsersRepository implements UsersRepositoryInterface
{
	public function GetLatestUsers()
	{
		return User::all();
	}

	public function GetUserById($id)
	{
		return  User::find($id);
	}

	public function DecreaseBalance($user, $amount)
	{
		$user->balance = $user->balance - $amount;
		$user->save();
	}

	public function IncreaseBalance($user, $amount)
	{
		$user->balance = $user->balance + $amount;
		$user->save();
	}

	public function GetUsersPositions()
	{
		return User::orderBy('balance', 'desc')->get();
	}

	public function GetUserGlobalPosition($id, $leagueId)
	{
		$sql = "SELECT `rank`
					FROM
					(
					  select @rownum:=@rownum+1 `rank`, p.* 
					  from portfolios p, (SELECT @rownum:=0) r 
					  WHERE league_id = " . $leagueId . "
					  order by balance DESC
					) s
					WHERE user_id = " . $id;
		$results = DB::select(DB::raw($sql));
		
		return $results[0]->rank;
	}
}