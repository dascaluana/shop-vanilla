<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected $table = "commands";

    public function photos()
    {
        return $this->morphMany(\App\Photo::class, 'imageable');
    }
}
