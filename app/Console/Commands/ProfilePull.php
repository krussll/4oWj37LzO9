<?php

namespace App\Console\Commands;

use DB;
use Auth;
use App\Profile;
use App\FollowerCount;
use App\TweetCount;
use Carbon\Carbon;
use Thujohn\Twitter\Facades\Twitter;
use Illuminate\Console\Command;

class ProfilePull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $now = Carbon::now();

      $profiles = [];
      foreach(Profile::get() as $profile)
      {
          $profiles[$profile->handle] = $profile->id;
      }

      $result = Twitter::getListMembers(["list_id" => "221897255", "count" => "5000"]);

      $addNewProfiles = false;
      $newprofiles = [];
      foreach($result->users as $member)
      {
        if($member->verified)
        {
          $screen_name = strtolower($member->screen_name);
          if (!array_key_exists($screen_name, $profiles))
          {
            $addNewProfiles = true;
            echo "adding " . $screen_name . " - ";
            // /echo $member->profile_image_url;
            $newprofiles[] = array('name' => $member->name, 'handle' => $screen_name, 'current_price' => 0, 'created_at' => $now, 'updated_at' => $now);
          }
          //echo $member->followers_count;
          //echo $member->statuses_count;

          //print_r($member);
          break;
        }
      }


      if($addNewProfiles)
      {
        //insert new profiles and reload array
        Profile::insert($newprofiles);

        $profiles = [];
        foreach(Profile::get() as $profile)
        {
            $profiles[$profile->handle] = $profile->id;
        }
      }

      $followerCounts = [];
      $tweetCounts = [];
      foreach($result->users as $member)
      {
        $screen_name = strtolower($member->screen_name);
        if (array_key_exists($screen_name, $profiles))
        {
          $profileId = $profiles[$screen_name];
          $followerCounts[] = array('profile_id' => $profileId, 'count' => $member->followers_count, 'created_at' => $now, 'updated_at' => $now);
          $tweetCounts[] = array('profile_id' => $profileId, 'count' => $member->statuses_count, 'created_at' => $now, 'updated_at' => $now);
        }
      }

      //FollowerCount::insert($followerCounts);
      TweetCount::insert($tweetCounts);

    }
}
