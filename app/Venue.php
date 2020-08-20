<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public $table = 'venues';

    

    protected $fillable = [
        'name',
        'slug',
        'address',
        'latitude',
        'features',
        'longitude',
        'created_at',
        'updated_at',
        'location_id',
        'description',
        'is_featured',
        'people_minimum',
        'people_maximum',
        'price_per_hour',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function event_types()
    {
        return $this->belongsToMany(EventType::class);
    }

    //
}
