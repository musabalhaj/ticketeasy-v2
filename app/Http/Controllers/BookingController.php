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
        $userName = DB::table('users')->where('name','LIKE',"%{$Search}%")->where('role','User')->first();
        if ($Search && $Search != ' ') {
            if ($userName) {
                $Booking = Booking::where('user_id','LIKE',"%{$userName->id}%")->paginate(10);
                if ($Booking->count() == 0) {
                    $Booking = Booking::paginate(10);

                    session()->flash('error','No Record With This Name');
                }
            }
            else{
                $Booking = Booking::paginate(10);
                session()->flash('error','No Record With This Name');
            }
        }
        else{
            $Booking = Booking::paginate(10);
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
