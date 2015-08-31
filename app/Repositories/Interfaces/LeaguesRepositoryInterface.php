<?php 

namespace App\Repositories\Interfaces;

interface LeaguesRepositoryInterface
{
    public function GetDefaultLeagues();

    public function CreateLeague($name, $initial_balance);

    public function AddUserToGlobalLeagues($userId);

    public function AddUserToLeague($userId, $leagueId, $initial_balance);
}