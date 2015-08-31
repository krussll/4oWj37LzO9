<?php

namespace App\Http\Controllers\API;

use Input;
use Auth;
use App\Hashtag;
use App\League;
use App\Portfolio;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\HashtagsRepository as HashtagsRepository;
use App\Repositories\UsersRepository as UsersRepository;
use App\Repositories\LeaguesRepository as LeaguesRepository;

class LeaguesController extends BaseController
{
    public function getUserPositions()
    {
        $rep = new UsersRepository();
        $data = array('global' => [['name' => 'overall', 'position' => $rep->GetUserGlobalPosition(Auth::user()->id, 1)]], 'private' => []);
        return response()->json($data);
    } 

    public function getGlobalLeaguePositions()
    {
        $rep = new UsersRepository();
        $leagueId = 1;
        $data = array('name' => 'Overall', 'positions' => $rep->GetUsersPositions(Auth::user()->id,  $leagueId));
        return response()->json($data);
    }

    public function createLeague()
    {
        $rep = new LeaguesRepository();        

        $rep->CreateLeague(Input::get('name'), 10000);
        
        return response()->json(array('name' => Input::get('name'), 'success' => true));
    } 
}
