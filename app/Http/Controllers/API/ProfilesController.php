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
    public function getLatestHashtags()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetLatestHashtags(10));
    }

    public function getHashtagsByName()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetHashtagsByNameLike(Input::get('tag')));
    }

    public function getHashtagById()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetHashtagById(Input::get('id')));
    }

    public function getPopularHashtags()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetPopularHashtags(7));
    }

    public function getProfilePriceHistoryById()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->GetHashtagPrices(Input::get('id')));
    }

    public function watchHashtag()
    {
      $hashtagId = Input::get('id');
      $userId = Auth::user()->id;
    }

    public function unWatchHashtag()
    {
      $hashtagId = Input::get('id');
    }

    public function getHashtagsList()
    {
        $rep = new ProfilesRepository();

        return response()->json($rep->HashtagsList(Input::get('page'), Input::get('length')));
    }

    public function getHashtagInfo()
    {
        $rep = new ProfilesRepository();
        $total = $rep->CountHashtags();
        return response()->json(array('total' => $total));
    }
}
