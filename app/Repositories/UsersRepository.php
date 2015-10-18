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
}
