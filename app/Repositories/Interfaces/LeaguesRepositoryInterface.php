<?php 

namespace App\Repositories\Interfaces;

interface LeaguesRepositoryInterface
{
    public function GetLeagueById($id);

    public function GetDefaultLeagues();

    public function CreateLeague($name, $initial_balance, $owner);

    public function AddUserToGlobalLeagues($userId);

    public function AddUserToLeague($userId, $leagueId, $initial_balance);

    public function GetUserGlobalPosition($id);

    public function GetUserPrivatePosition($id);

    public function GetLeaguePositions($leagueId);

    public function GetLeagueByCode($code);
}