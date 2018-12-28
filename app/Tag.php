<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";

    public function posts()
    {
        return $this->morphedByMany(\App\Post::class, 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany(\App\Video::class, 'taggable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
