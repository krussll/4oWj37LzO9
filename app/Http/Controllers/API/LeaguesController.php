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
use App\Repositories\PortfoliosRepository as PortfoliosRepository;

class LeaguesController extends BaseController
{
    public function getUserPositions()
    {
        $rep = new LeaguesRepository();
        $data = array('global' => $rep->GetUserGlobalPosition(Auth::user()->id), 'private' => $rep->GetUserPrivatePosition(Auth::user()->id));
        return response()->json($data);
    } 

    public function getLeaguePositions($id)
    {
        $rep = new LeaguesRepository();
   
        $data = array('name' => 'Overall', 'positions' => $rep->GetLeaguePositions($id));
        return response()->json($data);
    }

    public function createLeague()
    {
        $rep = new LeaguesRepository();        

        $id = $rep->CreateLeague(Input::get('name'), 10000, Auth::user()->id);
        
        return response()->json(array('id' => $id, 'success' => true));
    } 

    public function joinLeague($code)
    {
        $leagueRep = new LeaguesRepository();
        $portfolioRep = new PortfoliosRepository();

        $user = Auth::user(); 
        $league = $leagueRep->GetLeagueByCode($code);

        if($league == null)
        {
            return array('success' => false, 'message' => 'connot find a league for code: ' . $code);
        }


        if($portfolioRep->DoesLeaguePortfolioExist($user->id, $league->id))
        {
            return array('success' => false, 'message' => 'You already belong to this league');
        }

        $leagueRep->AddUserToLeague($user->id, $league->id, $league->initial_balance);

        return array('success' => true, 'id' => $league->id);
    }
}
