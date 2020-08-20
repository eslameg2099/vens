<?php

namespace App\Http\Controllers\Admin;
use App\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;
class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();

        return view('admin.locations.index', compact('locations'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');

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
            'name' => 'required',
            'image'=>'required',
            'slug' => 
                'required',
        ]);
        $request_data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/loc_images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            $request_data['image'] = $filename;
        }

        

        
        Location::create($request_data);
        return redirect()->route('admin.locations.index');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('admin.locations.show', compact('location'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $loc)
    {
        $this->validate($request,[
            'name' => 'required',
            'slug' => 
                    'required',
        ]);
      
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/loc_images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            if ($loc->image != null) {
                Storage::delete($location->image);
            }
            $loc->image = $filename;
        }
    
        $loc->name = $request->name;
        $loc->slug = $request->slug;
        $loc->save();
        return redirect()->route('admin.locations.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $image_path = public_path().'uploads/loc_images/'.$location->image;
        //dd($image_path);
             if(File::exists($image_path))
            {
    
               File::delete($image_path);
            //unlink($image_path);
            }
    
            $eventType->delete();
            return redirect()->route('admin.locations.index');

        //
    }
}
