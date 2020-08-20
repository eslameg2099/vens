<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    public $table = 'event_types';

   

   

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
        'image'
    ];

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }
    //
}
