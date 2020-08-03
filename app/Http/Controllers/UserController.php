<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\User;

class UserController extends Controller
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

    public function users(){
        if(auth()->user()->role == 'admin'){
            $users = User::all();
            return view('users/viewUsers', ['users' => $users]);
        }
        else{
            return redirect()->back();
        }
    }

    public function add(Request $request){
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => [ 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(\+255)[0-9]{9}$/', 'max:13'],
            'role' => ['required', 'string', 'max:150'],
            'zone' => ['required', 'string', 'max:150'],
            'gender' => ['required', 'string', 'max:5'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $newUser = new User;

        $newUser->fname = $request->input('fname');
        $newUser->mname = $request->input('mname');
        $newUser->lname = $request->input('lname');
        $newUser->username = $request->input('username');
        $newUser->phone = $request->input('phone');
        $newUser->role = $request->input('role');
        $newUser->gender = $request->input('gender');
        $newUser->zone = $request->input('zone');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request -> input('password'));

        $newUser->save();

        return redirect('/users')->with('info', 'user added successfully');

    }


    public function view($id){
        $user = User::find($id);
        return view('users/updateUser', ['user' => $user]);
    }

    public function update($id, Request $request){
        $user = User::find($id);

        $user->fname = $request->input('fname');
        $user->mname = $request->input('mname');
        $user->lname = $request->input('lname');
        $user->username = $request->input('username');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->zone = $request->input('zone');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');

        $user->save();

        return redirect('viewUser/'.$id)->with('info', 'user updated successful');
    }

    public function delete($id){
        User::where('id', $id)
        ->delete();
        
        return redirect('/users')->with('info', 'user deleted successfully');
    }

    public function viewProfile($id){
        $user = User::find($id);
        return view('users/profileSetup', compact('user'));
    }

    public function updateProfile(Request $request, $id){
        $validatedData = $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'mname' => [ 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(\+255)[0-9]{9}$/', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $update = User::find($id);// getting all details of a user with id = $id

        $phone_check = User::where('id', '!=', $id)->where('phone', $request->input('phone'));
        $email_check = User::where('id', '!=', $id)->where('email', $request->input('email'));

        if($phone_check->exists() || $email_check->exists()){
            return redirect ('profile/'.$id)->with('err', 'The phone number or email entered belongs to another user!');

        }elseif(!empty($request->input('current_password'))){
            $user = User::where('id', $id)->first(); //this returns the first match, but password doesn't returned
            // here the iput password is being hashed before compare it with the hased one in the users table
            $validCredentials = Hash::check($request->input('current_password'), $user->getAuthPassword()); // getAuthPassword helps to return the hashed password from users table

            if(!$validCredentials){
                return redirect ('profile/'.$id)->with('err', 'The current password entered does not match!');
            }else{
                $validatedData = $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'], //password validation
        
                ]);
               $update->password = Hash::make($request->input('password'));

            }
        }
        $update->fname = $request->input('fname');
        $update->mname = $request->input('mname');
        $update->lname = $request->input('lname');
        $update->username = $request->input('username');
        $update->phone = $request->input('phone');
        $update->email = $request->input('email');

        $update->save();

        return redirect('profile/'.$id)->with('info', 'user updated successful');
    }
}
