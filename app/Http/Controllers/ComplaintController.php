<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\Technician;
use App\User;

class ComplaintController extends Controller
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

    public function view(){
        if(auth()->user()->role == 'agent'){
            return view('complaints/complaints');
        }
        else{
            return redirect()->back();
        }
    }

    public function complaints(){
        if (auth()->user()->role == 'manager') {
            $technicians = Technician::where('status', 'available')
                                    ->where('zone', auth()->user()->zone)
                                    ->get(); // getting all the technicians with no assigned tasks corresponding to the zone manager's zone
            $complaints = Complaint::where('status', 'new')
                                    ->where('zone', auth()->user()->zone)
                                    ->get(); // getting all the new complaint which have not addressed corresponding to the zone manager's zone
            return view('complaints.viewComplaints', compact('complaints', 'technicians'));
        }
        else{
            return redirect()->back();
        }    
    }

    public function add(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'meter_no' => [ 'required','max:8', 'min:8'],
            'zone' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(\+255)[0-9]{9}$/', 'max:13'],
            'complaint_type' => ['required', 'string', 'max:50'],
            'report_medium' => ['required', 'string', 'max:255', ],
            'complaint_priority' => ['required', 'string', 'max:255',],
        ]);

        $complaints = new Complaint;

        $complaints->name = $request->input('name');
        $complaints->meter_no = $request->input('meter_no');
        $complaints->zone = $request->input('zone');
        $complaints->phone = $request->input('phone');
        $complaints->report_medium = $request->input('report_medium');
        $complaints->complaint_type = $request->input('complaint_type');
        $complaints->description = $request->input('description');
        $complaints->complaint_priority = $request->input('complaint_priority');

        $complaints->save();

        return redirect('/add_complaint')->with('info', 'complaint added successfully');
    }


    public function assignTask($id, Request $request){
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
        ]);
        $technician = $request->input('fname');

        $tech_status = Technician::where('fname', $technician)->first();
        $tech_status->status = 'assigned';
        $tech_status->complaint_id = $id;
        $tech_status->save();

        $complaint = Complaint::where('id', $id)->first();
        $complaint->status = "assigned";

        if($complaint->complaint_priority == 'high'){
            $complaint->duration = '1';
        }
        elseif($complaint->complaint_priority == 'medium'){
            $complaint->duration = '2';
        }
        else{
            $complaint->duration = '3';
        }
        $complaint->save();
        return \redirect('/complaints')->with('info', 'task assigned successfully');
    }


    public function complaintStatus(){
        if(auth()->user()->role != 'admin'){
            $complaints = Complaint::where('zone', auth()->user()->zone)->get();
            return view('complaints/complaintStatus', ['complaints'=>$complaints]);
        }
        else{
            return redirect()->back();
        } 
    }
}
