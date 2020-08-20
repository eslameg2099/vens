<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $table = 'locations';

   

   

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
        'image'
    ];

    public function venues()
    {
        return $this->hasMany(Venue::class, 'location_id', 'id');
    }
    //
}
