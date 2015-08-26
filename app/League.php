<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class League extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leagues';


    protected $fillable = array('name', 'code', 'initial_balance', 'start_at', 'end_at');
}
