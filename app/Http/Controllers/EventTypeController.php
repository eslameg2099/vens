<?php

namespace App\Http\Controllers;
use App\EventType;
use App\Venue;
use App\Location;

use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index($slug)
    {
        $eventType = EventType::where('slug', $slug)->firstOrFail();

        $eventTypes = EventType::all();
        $locations = Location::all();

        $venues = Venue::with('event_types')
            ->whereHas('event_types', function($q) use ($slug) {
                $q->where('event_types.slug', $slug);
            })
            ->latest()
            ->paginate(9);

        return view('event_type', compact('venues', 'eventType','eventTypes','locations'));
    }
    //
}
