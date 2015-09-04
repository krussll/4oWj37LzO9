<?php

namespace App\Http\Controllers\API;

use Input;
use Auth;
use App\Hashtag;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

//Define the required repositories
use App\Repositories\HashtagsRepository as HashtagsRepository;
use App\Repositories\UsersRepository as UsersRepository;

class HashtagsController extends BaseController
{
    public function getLatestHashtags()
    {
        $rep = new HashtagsRepository();

        return response()->json($rep->GetLatestHashtags(5));
    } 

    public function getHashtagsByName()
    {
        $rep = new HashtagsRepository();

        return response()->json($rep->GetHashtagsByNameLike(Input::get('tag')));
    }

    public function getHashtagById()
    {
        $rep = new HashtagsRepository();

        return response()->json($rep->GetHashtagById(Input::get('id')));
    } 

    public function getPopularHashtags()
    {
        $rep = new HashtagsRepository();

        return response()->json($rep->GetPopularHashtags(5));
    } 

    public function getHashtagCountsById()
    {
        $rep = new HashtagsRepository();

        return response()->json($rep->GetHashtagPrices(Input::get('id')));
    }

    public function getHashtagsList()
    {
        $rep = new HashtagsRepository();

        return response()->json($rep->HashtagsList(Input::get('page'), Input::get('length')));
    } 

    public function getHashtagInfo()
    {
        $rep = new HashtagsRepository();
        $total = $rep->CountHashtags();
        return response()->json(array('total' => $total));
    }
}
