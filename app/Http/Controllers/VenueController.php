<?php

namespace App\Http\Controllers;
use App\Venue;
use App\EventType;
use App\Location;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    //
    public function show($slug, $id) {
        $venue = Venue::with('event_types', 'location')->where('slug', $slug)->where('id', $id)->firstOrFail();

        $relatedVenues = Venue::with('event_types')->where('location_id', $venue->location_id)->where('id', '!=', $venue->id)->take(3)->get();

        $featuredVenues = Venue::where('is_featured', 1)->get();

        $eventTypes = EventType::all();
        $locations = Location::all();


        return view('venue', compact('venue', 'relatedVenues','featuredVenues', 'eventTypes', 'locations'));
    }
}
