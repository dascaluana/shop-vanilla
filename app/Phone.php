<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = "phones";

    protected $fillable = [
        'person_id', 'number',
    ];
    public function person()
    {
        return $this->belongsTo(\App\Person::class);
    }
}
