<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Technician;

class TechnicianController extends Controller
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
        if(auth()->user()->role == 'manager'){
            $technicians = Technician::where('zone', auth()->user()->zone)->get();
            return view('technicians/technicians', ['technicians' => $technicians]);
        }
        else{
            return redirect()->back();
        } 
    }
    public function register(Request $request){
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => [ 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(\+255)[0-9]{9}$/', 'max:13'],
            'gender' => ['required', 'string', 'max:5'],
            'zone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $newTechnician = new Technician;

        $tech_phone = $request->input('phone');
        if($newTechnician::where('phone', $tech_phone)->exists()){
            return redirect('/view_tech')->with('err', 'user phone exists');
        }else{
            $newTechnician->fname = $request->input('fname');
            $newTechnician->mname = $request->input('mname');
            $newTechnician->lname = $request->input('lname');
            $newTechnician->phone = $request->input('phone');
            $newTechnician->gender = $request->input('gender');
            $newTechnician->email = $request->input('email');
            $newTechnician->zone = $request->input('zone');

            $newTechnician->save();

            return redirect('/view_tech')->with('info', 'user added successfully');
        }
        
    }

    public function delete($id){
        Technician::where('id', $id)
        ->delete();

        return \redirect('/view_tech')->with('info', 'Technician deleted successfully');
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => [ 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(\+255)[0-9]{9}$/', 'max:13'],
            'gender' => ['required', 'string', 'max:5'],
            'zone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $tech_update = Technician::find($id);

        $tech_update->fname = $request->input('fname');
        $tech_update->mname = $request->input('mname');
        $tech_update->lname = $request->input('lname');
        $tech_update->phone = $request->input('phone');
        $tech_update->gender = $request->input('gender');
        $tech_update->email = $request->input('email');
        $tech_update->zone = $request->input('zone');

        $tech_update->save();

        return redirect('updateTechnician/'.$id)->with('info', 'technician added successfully');
    }
}
