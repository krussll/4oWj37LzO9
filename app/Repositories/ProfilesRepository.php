<?php
namespace App\Repositories;

use DB;
use App\Profile;
use App\FollowerCount;
use Carbon\Carbon;
use App\Repositories\Interfaces\ProfilesRepositoryInterface as ProfilesRepositoryInterface;

class ProfilesRepository implements ProfilesRepositoryInterface
{
	public function GetLatestProfiles($limit)
	{
		return Profile::where('is_active', true)->take($limit)->orderBy('created_at', 'DESC')->get();
	}

	public function GetProfilesByNameLike($tag)
	{

		return Profile::where('handle', 'like', '%' . $tag . '%')->orwhere('name', 'like', '%' . $tag . '%')->where('is_active', true)->get();
	}

	public function GetProfileById($id)
	{
		return Profile::find($id);
	}

	public function GetPopularProfiles($limit)
	{
		$date = new Carbon;
        $date->subHours(1);
		return Profile::where('is_active', true)->take($limit)->get();
	}

	public function GetProfilePrices($id)
	{
		$date = new Carbon;
    $date->subDays(4);


		$prices = DB::table('profile_history_prices')
                    ->where('created_at', '>', $date->toDateTimeString())
                    ->where('profile_id', $id)
                    ->get(['created_at', 'price']);

		$hashtag = $this->GetProfileById($id);

		if ($hashtag->created_at > $date)
		{
			 array_unshift($prices, array('price' => 0, 'created_at' => $hashtag->created_at->toDateTimeString()));
			 array_unshift($prices, array('price' => 0, 'created_at' => $date->toDateTimeString()));
		}

		return $prices;
	}

	public function ProfilesList($page, $length)
	{
		$skip = 0;
		if($page > 1)
		{
			$skip = ($page--) * $length;
		}

		return Profile::where('is_active', true)->take($length)->skip($skip)->orderBy('current_price', 'DESC')->get();
	}

	public function CountProfiles()
	{
		return Profile::where('is_active', true)->count();
	}
}
