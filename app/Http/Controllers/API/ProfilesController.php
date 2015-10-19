<?php

namespace App\Http\Controllers\API;

use Input;
use Auth;
use App\Hashtag;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\ProfilesRepository as ProfilesRepository;
use App\Repositories\UsersRepository as UsersRepository;

class ProfilesController extends BaseController
{
    public function getLatestProfiles()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetLatestHashtags(10));
    }

    public function getProfilesByName()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetHashtagsByNameLike(Input::get('tag')));
    }

    public function GetProfileById()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetProfileById(Input::get('id')));
    }

    public function getPopularProfiles()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetPopularProfiles(7));
    }

    public function getProfilePriceHistoryById()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetProfilePrices(Input::get('id')));
    }

    public function getProfilesList()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->ProfilesList(Input::get('page'), Input::get('length')));
    }

    public function getProfileInfo()
    {
        $rep = new ProfilesRepository();
        $total = $rep->CountProfiles();
        return response()->json(array('total' => $total));
    }
}
