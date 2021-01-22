<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartJsController extends Controller
{
    public function index()
    {
        $year = ['2019','2020','2021','2022','2023','2024','2025','2026','2027','2028','2029','2030'];

        $user = [];
        $organizer = [];
        foreach ($year as $key => $value) {
            $user[] = User::where('role','User')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
            $organizer[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }
        foreach ($year as $key => $value) {
            $organizer[] = User::where('role','Organizer')->where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count('id');
        }

        return view('report')
        ->with('year',json_encode($year,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK))
        ->with('organizer',json_encode($organizer,JSON_NUMERIC_CHECK));
    }
}
