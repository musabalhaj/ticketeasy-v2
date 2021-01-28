<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::where('status',0)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // fields you want to validate
         $rules = array(
            'title'=>'required|min:4|max:50',
            'description'=>'required|min:4|max:500',
            'tickets'=>'required|Numeric',
            'price'=>'required|Numeric',
            'date'=>'required|Date',
            'location'=>'required||min:4|max:50',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'organizer_id'=>'required|Numeric',
        );

        // validate all data that come from request
        $validator = Validator::make($request->all(),$rules);

        // check if you have errors in the data
        if ($validator->fails()) {

            return response()->json($validator->errors(),401);
        }  

        // else create new Event with requested data   
        else{
            
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            // uplode the Event image
            request()->image->move(public_path('storage/Events'),$imageName);

            $Event= Event::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'tickets'=>$request->tickets,
                'avilable_seats'=>$request->tickets,
                'price'=>$request->price,
                'date'=>$request->date,
                'location'=>$request->location,
                'image'=>$imageName,
                'organizer_id'=>$request->organizer_id
            ]);

            return ['Success'=>'Event Created Successfuly.'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Event::findOrFail($id);
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
        $Event = Event::findOrFail($id);

        // fields you want to validate
        $rules = array(
            'title'=>'required|min:4|max:50',
            'description'=>'required|min:4|max:500',
            'tickets'=>'required|Numeric',
            'price'=>'required|Numeric',
            'date'=>'required|Date',
            'location'=>'required|min:4|max:50',
            'organizer_id'=>'required|Numeric',
        );

        // validate all data that come from request
        $validator = Validator::make($request->all(),$rules);

        // check if you have errors in the data
        if ($validator->fails()) {

            return response()->json($validator->errors(),401);
        }  

        // else update Event with requested data   
        else{

            //check if the user want to update event image
            if ($request->hasFile('image')) {
            
                //check if image exist in the events folder.
                if (file_exists(public_path('storage/Events/'.$Event->image))) {

                    unlink('storage/Events/'.$Event->image);  //delete event old image
                } 
            
                $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
                //uplode the event new image
                request()->image->move(public_path('storage/Events'),$imageName); 
                
                //update the event data
                $Event->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'tickets'=>$request->tickets,
                    'avilable_seats'=>$request->tickets,
                    'price'=>$request->price,
                    'date'=>$request->date,
                    'location'=>$request->location,
                    'image'=>$imageName,
                    'organizer_id'=>$request->organizer_id
                ]);

                return ['Success'=>'Event Updated Successfuly.'];
            }
            // if the user donnot want to update event image
            else{
                //update the event data
                $Event->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'tickets'=>$request->tickets,
                    'avilable_seats'=>$request->tickets,
                    'price'=>$request->price,
                    'date'=>$request->date,
                    'location'=>$request->location,
                    'organizer_id'=>$request->organizer_id
                ]);

                return ['Success'=>'Event Updated Successfuly.'];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Event = Event::findOrFail($id);

        //check if image exist in the events folder.
        if (file_exists(public_path('storage/Events/'.$Event->image))) {

            unlink('storage/Events/'.$Event->image);

        }
        //delete event data
        $Event->delete();

        return ['Success'=>'Event Deleted Successfuly.'];
    }
}
