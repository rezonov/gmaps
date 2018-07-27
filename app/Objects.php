<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Objects extends Eloquent
{
    //
    protected $collection = 'objects';

    public function cats_objects()
    {
        return $this->belongsTo(Cats__Objects::class, '_id', 'id_object');
    }

    public function cats_cities() {
        return $this->belongsTo(Cities::class, "city","_id");
    }

}
