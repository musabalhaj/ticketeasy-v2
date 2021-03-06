<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Search = $request->search;
        $eventName = DB::table('events')->where('title','LIKE',"%{$Search}%")->first();
        if ($Search && $Search != ' ') {
            if ($eventName) {
                $Booking = Booking::where('event_id','LIKE',"%{$eventName->id}%")->orderByDesc('id')->paginate(20);
                if ($Booking->count() == 0) {
                    $Booking = Booking::orderByDesc('id')->paginate(20);

                    session()->flash('error','No Record With This Name');

                    return redirect()->back();
                }
            }
            else{
                $Booking = Booking::orderByDesc('id')->paginate(20);
                session()->flash('error','No Record With This Name');

                return redirect()->back();
            }
        }
        else{
            $Booking = Booking::orderByDesc('id')->paginate(20);
        }
        return view('Admin/Booking.index')
        ->with('Bookings', $Booking)
        ->with('Users', User::where('role','User')->get(['id','name']))
        ->with('Events', Event::get(['id','title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
