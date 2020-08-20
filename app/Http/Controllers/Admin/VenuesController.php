<?php

namespace App\Http\Controllers\Admin;
use App\EventType;

use App\Location;
use App\Venue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;
class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();

        return view('admin.venues.index', compact('venues'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event_types = EventType::all()->pluck('name', 'id');

        return view('admin.venues.create', compact('locations', 'event_types'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
       


        $request->validate([
            'name'           => 
                'required',
            
            'slug'           => 
                'required',
            
            'location_id'    => 
                'required',
                
            
            'event_types.*'  => 
                'integer',
            
            'event_types'    => 
                'array',
            
            'address'        => 
                'required',
            
            'people_minimum' => 
                'required',
                
            
            'people_maximum' => 
                'required',
               
                'image'=>'required',

        
        ]);
        $request_data = $request->except(['image']);

        $request->merge([ 
            'event_types' => implode(',', (array) $request->get('event_types'))
        ]);

      
      

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/ven_images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            $request_data['image'] = $filename;
        }
    
        $venue = Venue::create($request_data);
        $venue->event_types()->sync($request->input('event_types', []));
        return redirect()->route('admin.venues.index');


        //
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {

        $venue->load('location', 'event_types');

        return view('admin.venues.show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        $locations = Location::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event_types = EventType::all()->pluck('name', 'id');

        $venue->load('location', 'event_types');

        return view('admin.venues.edit', compact('locations', 'event_types', 'venue'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return back();
        //
    }
}
