<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Cities extends Eloquent
{
    //
    protected $collection = 'cities';

    protected $fillable = ['name'];
}
