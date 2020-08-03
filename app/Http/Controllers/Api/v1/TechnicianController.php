<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Technician;
use App\Http\Resources\Resources\TechResource;

class TechnicianController extends Controller
{
    public function store(Request $request): TechResource
    {
        $request -> validate([
            'email'=> ['required', 'string', 'email', 'max:255'],
            'lname'=> 'required'
        ]);

        $email = $request->input('email');
        $lname = $request->input('lname');

        $check = Technician::where('email', $email)
                    ->whereRaw('lower(lname) = ? ', \strtolower($lname));
                    

        if($check->exists())
        {
                $token = Technician::where('phone', $check->pluck('phone'))->get('api_token');

                return new TechResource($token);
            
        }else{
            return new TechResource([404]);
        }
    }
}
