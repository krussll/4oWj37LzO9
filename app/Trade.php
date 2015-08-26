<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class Trade extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trades';

    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio');
    }

    public function hashtag()
    {
        return $this->belongsTo('App\Hashtag');
    }

}
