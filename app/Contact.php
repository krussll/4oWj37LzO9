<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class Contact extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contact';


    protected $fillable = array('email', 'subject', 'message');

}
