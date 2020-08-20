<?php

namespace App\Http\Controllers;
use App\EventType;
use App\Location;
use App\Venue;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredVenues = Venue::where('is_featured', 1)->get();

        $eventTypes = EventType::all();
        $locations = Location::all();

        $newestVenues = Venue::with('event_types')->latest()->take(3)->get();

        return view('home', compact('featuredVenues', 'eventTypes', 'locations', 'newestVenues'));
    }
}
