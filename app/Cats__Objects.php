<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Cats__Objects extends Eloquent
{
    //
    protected $table = 'cats__objects';

    protected $fillable = ['id_object', 'id_cat'];
}
