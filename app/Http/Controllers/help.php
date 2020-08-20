<?php

namespace App\Http\Controllers;
use App\EventType;
use App\Location;
use App\Venue;
use Illuminate\Http\Request;

class help extends Controller
{
    public function conect()
    {
        $featuredVenues = Venue::where('is_featured', 1)->get();

        $eventTypes = EventType::all();
        $locations = Location::all();

        $newestVenues = Venue::with('event_types')->latest()->take(3)->get();

        return view('contact', compact('featuredVenues', 'eventTypes', 'locations', 'newestVenues'));
    }

    public function about()
    {
        $featuredVenues = Venue::where('is_featured', 1)->get();

        $eventTypes = EventType::all();
        $locations = Location::all();

        $newestVenues = Venue::with('event_types')->latest()->take(3)->get();

        return view('about', compact('featuredVenues', 'eventTypes', 'locations', 'newestVenues'));
    }


    //
}
