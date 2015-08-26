<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class Portfolio extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'portfolios';


    protected $fillable = array('user_id', 'league_id', 'balance', 'is_active');

}
