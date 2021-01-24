<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $year = ['2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035'];
        
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $user = [];
        $event = [];
        $event2 = [];
        $user2 = [];
        $organizer = [];
        $organizer2 = [];
        $PaiedTicketMonthly = [];
        $UnPaiedTicketMonthly = [];
        $PaiedTicketYearly = [];
        $UnPaiedTicketYearly = [];
        foreach ($year as $key => $value) {
            $user[] = User::where('role','User')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
            $organizer[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $user2[] = User::where('role','User')->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $organizer[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $organizer2[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $event[] = Event::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $event2[] = Event::where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $PaiedTicketMonthly[] = Booking::where('ticket_status',2)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $UnPaiedTicketMonthly[] = Booking::where('ticket_status',1)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $PaiedTicketYearly[] = Booking::where('ticket_status',2)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $UnPaiedTicketYearly[] = Booking::where('ticket_status',1)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $ValidTicketMonthly[] = Booking::where('status',0)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $InValidTicketMonthly[] = Booking::where('status',1)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $ValidTicketYearly[] = Booking::where('status',0)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $InValidTicketYearly[] = Booking::where('status',1)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }

        return view('Report.index')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK))
        ->with('user2',json_encode($user2,JSON_NUMERIC_CHECK))
        ->with('event',json_encode($event,JSON_NUMERIC_CHECK))
        ->with('event2',json_encode($event2,JSON_NUMERIC_CHECK))
        ->with('PaiedTicketMonthly',json_encode($PaiedTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('UnPaiedTicketMonthly',json_encode($UnPaiedTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('PaiedTicketYearly',json_encode($PaiedTicketYearly,JSON_NUMERIC_CHECK))
        ->with('UnPaiedTicketYearly',json_encode($UnPaiedTicketYearly,JSON_NUMERIC_CHECK))
        ->with('ValidTicketMonthly',json_encode($ValidTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('InValidTicketMonthly',json_encode($InValidTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('ValidTicketYearly',json_encode($ValidTicketYearly,JSON_NUMERIC_CHECK))
        ->with('InValidTicketYearly',json_encode($InValidTicketYearly,JSON_NUMERIC_CHECK))
        ->with('organizer',json_encode($organizer,JSON_NUMERIC_CHECK))
        ->with('organizer2',json_encode($organizer2,JSON_NUMERIC_CHECK));
    }

    public function user(){

        $year = ['2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035'];
        
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $user = [];
        $user2 = [];
        foreach ($year as $key => $value) {
            $user[] = User::where('role','User')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $user2[] = User::where('role','User')->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        return view('Report.user')
        ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK))
        ->with('user2',json_encode($user2,JSON_NUMERIC_CHECK));

    }
    public function organizer(){

        $year = ['2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035'];
        
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $organizer = [];
        $organizer2 = [];
        foreach ($year as $key => $value) {
            $organizer[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $organizer2[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        return view('Report.organizer')
        ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('organizer',json_encode($organizer,JSON_NUMERIC_CHECK))
        ->with('organizer2',json_encode($organizer2,JSON_NUMERIC_CHECK));

    }

    public function booking(){

        $year = ['2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035'];
        
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $PaiedTicketMonthly = [];
        $UnPaiedTicketMonthly = [];
        $PaiedTicketYearly = [];
        $UnPaiedTicketYearly = [];

        foreach ($month as $key => $value) {
            $PaiedTicketMonthly[] = Booking::where('ticket_status',2)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $UnPaiedTicketMonthly[] = Booking::where('ticket_status',1)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $PaiedTicketYearly[] = Booking::where('ticket_status',2)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $UnPaiedTicketYearly[] = Booking::where('ticket_status',1)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $ValidTicketMonthly[] = Booking::where('status',0)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $InValidTicketMonthly[] = Booking::where('status',1)->where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $ValidTicketYearly[] = Booking::where('status',0)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $InValidTicketYearly[] = Booking::where('status',1)->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }

        return view('Report.booking')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
        ->with('PaiedTicketMonthly',json_encode($PaiedTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('UnPaiedTicketMonthly',json_encode($UnPaiedTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('PaiedTicketYearly',json_encode($PaiedTicketYearly,JSON_NUMERIC_CHECK))
        ->with('UnPaiedTicketYearly',json_encode($UnPaiedTicketYearly,JSON_NUMERIC_CHECK))
        ->with('ValidTicketMonthly',json_encode($ValidTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('InValidTicketMonthly',json_encode($InValidTicketMonthly,JSON_NUMERIC_CHECK))
        ->with('ValidTicketYearly',json_encode($ValidTicketYearly,JSON_NUMERIC_CHECK))
        ->with('InValidTicketYearly',json_encode($InValidTicketYearly,JSON_NUMERIC_CHECK));
    }

    public function event()
    {
        $year = ['2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035'];
        
        $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $event = [];
        $event2 = [];
        foreach ($year as $key => $value) {
            $event[] = Event::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($month as $key => $value) {
            $event2[] = Event::where(DB::raw("DATE_FORMAT(created_at, '%m')"),$value)->count('id');
        }

        return view('Report.event')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
        ->with('event2',json_encode($event2,JSON_NUMERIC_CHECK))
        ->with('event',json_encode($event,JSON_NUMERIC_CHECK));
    }
}
