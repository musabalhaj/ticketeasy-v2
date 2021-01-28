<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Search = $request->search;
            //----------------  Admin----------------//
        if (auth()->user()->role == 'Admin') {
            if ($Search && $Search != ' ') {
                $Event = Event::where('title','LIKE',"%{$Search}%")->paginate(10);
                if ($Event->count() == 0) {
                    $Event = Event::paginate(10);

                    session()->flash('error','No Record With This Title');

                    return redirect()->back();
                }
            }
            else{
                $Event = Event::paginate(10);
            }
            return view('Admin/Event.index')
            ->with('Events', $Event)
            ->with('Users', User::where('role','Organizer')->get(['id','name']));
        }
           //----------------  Organizer----------------// 
        else{
            if ($Search && $Search != ' ') {
                $Event = Event::where('title','LIKE',"%{$Search}%")->where('organizer_id',auth()->user()->id)->paginate(10);
                if ($Event->count() == 0) {
                    $Event = Event::where('organizer_id',auth()->user()->id)->paginate(10);

                    session()->flash('error','No Record With This Title');
                    
                    return redirect()->back();
                }
            }
            else{
                $Event = Event::where('organizer_id',auth()->user()->id)->paginate(10);
            }
            return view('Admin/Event.organizerEvent')
            ->with('Events', $Event);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Event.create')
        ->with('Organizers',User::where('role','Organizer')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request ,Event $Event)
    {
        
        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        // uplode the Event image
        request()->image->move(public_path('storage/Events'),$imageName);

        $Event->create([
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

        session()->flash('success','Added Successfully');
        
        return redirect(route('Event.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $Event)
    {
        return view('Admin/Event.show')->with('Event',$Event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $Event)
    {
        return view('Admin/Event.edit')
        ->with('Event',$Event)
        ->with('Organizers',User::where('role','Organizer')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $Event)
    {
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
        }

        session()->flash('success','Updated Successfully');
        
        return redirect(route('Event.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $Event)
    {
        //check if image exist in the events folder.
        if (file_exists(public_path('storage/Events/'.$Event->image))) {

            unlink('storage/Events/'.$Event->image);

        }
        //delete event data
        $Event->delete();

        session()->flash('success','Deleted Successfully');
        
        return redirect(route('Event.index'));
    }
}
