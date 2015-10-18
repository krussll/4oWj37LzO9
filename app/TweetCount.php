<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class TweetCount extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tweet_counts';

public function hashtag()
    {
        return $this->belongsTo('App\Profile');
    }

}
