<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class Profile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';
    protected $hidden = ['prices', 'priceHistory'];

    public function prices()
    {
        return $this->hasMany('App\ProfilePrice');
    }

    public function priceHistory()
    {
        return $this->hasMany('App\ProfilePriceHistory');
    }

    public function counts()
    {
        return $this->hasMany('App\FollowerCount');
    }


    public function getCurrentPriceAttribute($val)
    {
      if ($this->prices->isEmpty())
      {
        return 0;
      }

      return $this->prices->last()->price;
    }

}
