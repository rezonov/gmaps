<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Cats extends Eloquent
{
    //
    protected $collection = 'cats';

    protected $fillable = ['name', 'url'];

    public function cats_objects()
    {
        return $this->belongTo(Cats__Objects::class, 'id_object', '_id');
    }


}
