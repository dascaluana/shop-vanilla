<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "people";

    public function phone()
    {
        return $this->hasOne(App\Phone::class);
    }

    public function posts()
    {
        return $this->belongsTo(\App\Post::class);
    }

    public function countries()
    {
        return $this->belongsTo(\App\Country::class);
    }
}
