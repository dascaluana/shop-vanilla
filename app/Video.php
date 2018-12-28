<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "videos";

    public function tags()
    {
        return $this->morphToMany(\App\Tag::class, 'taggable');
    }
}
