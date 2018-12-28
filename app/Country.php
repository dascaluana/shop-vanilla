<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";

    public function posts()
    {
        return $this->hasManyThrough(\App\Post::class, 'App\Person');
    }
}
