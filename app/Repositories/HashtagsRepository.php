<?php
namespace App\Repositories;

use DB;
use App\Hashtag;
use App\HashtagCount;
use Carbon\Carbon;
use App\Repositories\Interfaces\HashtagsRepositoryInterface as HashtagsRepositoryInterface;

class HashtagsRepository implements HashtagsRepositoryInterface
{
	public function GetLatestHashtags($limit)
	{
		return Hashtag::take($limit)->orderBy('created_at', 'DESC')->get();
	}

	public function GetHashtagsByNameLike($tag)
	{

		return Hashtag::where('tag', 'like', $tag . '%')->get();
	}

	public function GetHashtagById($id)
	{
		return Hashtag::find($id);
	}

	public function GetPopularHashtags($limit)
	{
		$date = new Carbon;
        $date->subHours(1);
		return DB::table('hashtag_count')
                    ->leftJoin('hashtags', 'hashtags.id', '=', 'hashtag_count.hashtag_id')
                    ->where('hashtag_count.created_at', '>', $date->toDateTimeString())
                    ->where('current_price', '>', '0')
                    ->groupBy('hashtags.tag')
                    ->orderBy(DB::raw('SUM(hashtag_count.count)'), 'DESC')
                    ->take($limit)
                    ->get();
	}

	public function GetHashtagPrices($id)
	{
		$date = new Carbon;
        $date->subDays(4);
		return DB::table('hashtag_price')
                    ->where('created_at', '>', $date->toDateTimeString())
                    ->where('hashtag_id', $id)
                    ->get(['created_at', 'amount']);
	}

	public function HashtagsList($page, $length)
	{
		$skip = 0;
		if($page > 1)
		{
			$skip = ($page--) * $length;
		}
		
		return Hashtag::take($length)->skip($skip)->orderBy('current_price', 'DESC')->get();
	}

	public function CountHashtags()
	{
		return Hashtag::count();
	}
}