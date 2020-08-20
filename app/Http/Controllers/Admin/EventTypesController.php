<?php

namespace App\Http\Controllers\Admin;
use App\EventType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventTypeRequest;
use App\Http\Requests\UpdateEventTypeRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;


class EventTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventTypes = EventType::all();

        return view('admin.eventTypes.index', compact('eventTypes'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eventTypes.create');

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
            $location = public_path('/uploads/event_images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            $request_data['image'] = $filename;
        }

        

        
        EventType::create($request_data);
        return redirect()->route('admin.event-types.index');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EventType $eventType)
    {
        return view('admin.eventTypes.show', compact('eventType'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EventType $eventType)
    {
        return view('admin.eventTypes.edit', compact('eventType'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,EventType $eventType )
    {
        $this->validate($request,[
        'name' => 'required',
        'slug' => 
                'required',
    ]);
  
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('/uploads/event_images/' . $filename);
        Image::make($image)->resize(800, 600)->save($location);
        if ($eventType->image != null) {
            Storage::delete($eventType->image);
        }
        $eventType->image = $filename;
    }

    $eventType->name = $request->name;
    $eventType->slug = $request->slug;
    $eventType->save();
    return redirect()->route('admin.event-types.index');


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventType $eventType)
    {
        $image_path = public_path().'uploads/event_images/'.$eventType->image;
        //dd($image_path);
             if(File::exists($image_path))
            {
    
               File::delete($image_path);
            //unlink($image_path);
            }
    
            $eventType->delete();
            return redirect()->route('admin.event-types.index');

        //
    }
}
