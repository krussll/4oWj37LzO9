<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class BetaRequest extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'beta_wait_list';


    protected $fillable = ['email'];

}
