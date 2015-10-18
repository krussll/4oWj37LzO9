<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class FollowerCount extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'follower_counts';

public function hashtag()
    {
        return $this->belongsTo('App\Profile');
    }

}
