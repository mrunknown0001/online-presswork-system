<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);

    	$username = $request['username'];
    	$password = $request['password'];

    	// attempt to login
    	// redirect intedned or to user type dashboard
    	if(Auth::attempt(['username' => $username, 'password' => $password])) {
    		// redirect to specific user type dashboard
    		if(Auth::user()->user_type == 1) {
    			// add activity log for audit trail
    			
    			return redirect()->route('admin.dashboard');
    		}
    	}

    	return redirect()->back()->with('error', 'Invalid Username or Password!');
    }
}
