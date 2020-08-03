<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \GuzzleHttp\Client;
use App\Complaint;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = new Client();
        $response = $client->get('http://desolate-shelf-21097.herokuapp.com/customer');
        $resp = json_decode($response->getBody());

        $this->middleware(auth()->user());
        $user_zone = auth()->user()->zone;
        
        $total_complaints = Complaint::where('zone',  $user_zone)
                                    ->whereMonth('complaints.updated_at', date('m'))
                                    ->get('complaint_type')->count('complaint_type');
// return $total_complaints;
        $new_complaints = Complaint::where('status', 'new')
                                    ->where('zone',  $user_zone)
                                    ->whereMonth('updated_at', date('m'))
                                    ->get('complaint_type')->count('complaint_type');

        $completed_complaints = Complaint::where('status', 'completed')
                                        ->where('zone',  $user_zone)
                                        ->whereMonth('updated_at', date('m'))
                                        ->get('complaint_type')->count('complaint_type');

        $progress_complaints = Complaint::where('status', 'assigned')
                                        ->where('zone',  $user_zone)
                                        ->whereMonth('updated_at', date('m'))
                                        ->get('complaint_type')->count('complaint_type');
        
        return view('home', ['resp'=>$resp], compact('total_complaints','new_complaints', 'completed_complaints', 'progress_complaints'));
    }
}
