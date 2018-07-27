<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Reviews extends Eloquent
{
    //
    protected $collection = 'reviews_table';

    protected $fillable = ['name'];
}
