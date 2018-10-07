<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
    	// check if authenticated
    	if(Auth::check()) {
    		return redirect()->route('login');
    	}

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
    		// add activity log for audit trail
			$action = 'Login';
			GeneralController::activity_log($action);

    		if(Auth::user()->user_type == 1) {
    			return redirect()->route('admin.dashboard');
    		}
            else if(Auth::user()->user_type == 2) {
                return redirect()->route('eic.dashboard');
            }
    	}

    	return redirect()->back()->with('error', 'Invalid Username or Password!');
    }
}
