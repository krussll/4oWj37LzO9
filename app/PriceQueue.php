<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model as Model;

class PriceQueue extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'price_queue';

    protected $fillable = ['price', 'hashtag_id'];


}
