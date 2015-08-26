<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class HashtagCount extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hashtag_count';

public function hashtag()
    {
        return $this->belongsTo('App\Hashtag');
    }

}
