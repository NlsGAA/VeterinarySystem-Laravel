<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//4|IpTDLDusunMszovdIk6tXvqBo2raSG5FCfn2QKIp69c394eb
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            return response()->json(['token' => $request->user()->createToken('invoice')->plainTextToken]);
        }
        return response()->json('Not authorized', 403);
    }
}
