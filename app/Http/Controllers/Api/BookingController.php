<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get paied and valid booking
        return Booking::where('ticket_status',2)->where('status',0)->get();
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
            'user_id'=>'required',
            'event_id'=>'required',
            'seats'=>'required',
        );

        // validate all data that come from request
        $validator = Validator::make($request->all(),$rules);

        // check if you have errors in the data
        if ($validator->fails()) {

            return response()->json($validator->errors(),401);
        }  

        // else create new booking with requested data   
        else{

            $event_id = $request->event_id;
            $seats = $request->seats;

            // get event data
            $event = Event::findOrFail($event_id);

            //set booking amount (seats * event price)
            $amount = $request->seats * $event->price;

            //check for seats
            $avilableSeats = $event->avilable_seats;

            // check avilable seats 
            if ($seats <= $avilableSeats) {

                $Booking = new Booking();
                $Booking->user_id = $request->user_id;
                $Booking->event_id = $event_id;
                $Booking->seats = $seats;
                $Booking->amount = $amount;
                $Booking->save();
                
                //update avilable Seats field.
                $remaining_seats = $event->avilable_seats - $seats ;
                DB::table('events')->where('id',$event_id)->update(['avilable_seats' => $remaining_seats]);

                // currnt booking id
                $BookingId = $Booking->id;

                // redirect to sayber pay route with BookingId
                // $url = route('payment',['order_id' =>$BookingId]);
                // return redirect($url);
                
                return ['Success'=>'Booking Successfuly.'];

            }
            else{

                return ['Error'=>'No Avilable Seats.'];

            }
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
        return Booking::findOrFail($id);   
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
    public function destroy($id)
    {
        //
    }
}
