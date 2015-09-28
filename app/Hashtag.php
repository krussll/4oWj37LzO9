<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class Hashtag extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hashtags';
    protected $hidden = ['prices'];

    public function prices()
    {
        return $this->hasMany('App\HashtagPrice');
    }

    public function counts()
    {
        return $this->hasMany('App\HashtagCount');
    }


    public function getCurrentPriceAttribute($val)
    {
      if ($this->prices->isEmpty())
      {
        return 0;
      }

      return $this->prices->last()->amount;
    }

}
