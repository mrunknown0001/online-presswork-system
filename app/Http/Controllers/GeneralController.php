<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\ActivityLog;

class GeneralController extends Controller
{
	public function landing()
	{
		return $this->check_auth('landing');
	}

	public function login()
	{
		return $this->check_auth('login');
	}
    
	public function check_auth($view)
	{
		if(Auth::check()) {
			if(Auth::user()->user_type == 1) {
				return redirect()->route('admin.dashboard');
			}
			else if(Auth::user()->user_type == 2) {
				return redirect()->route('eic.dashboard');
			}
			else if(Auth::user()->user_type == 3) {
				return redirect()->route('layout.editor.dashboard');
			}
			else if(Auth::user()->user_type == 4) {
				return redirect()->route('section.editor.dashboard');
			}
			else if(Auth::user()->user_type == 5) {
				return redirect()->route('correspondent.dashboard');
			}
		}

		return view($view);
	}


	// method use to logout all users
    public function logout()
    {
    	// add activity log for logout
    	if(Auth::check()) {
    		$action = 'Logout';
    		$this->activity_log($action);
    	}

    	Auth::logout();

    	return redirect()->route('landing');
    }


    // method use to store logs for all activities in all users
    public static function activity_log($action = null)
    {
    	$a = new ActivityLog();
    	$a->user_id = Auth::user()->id;
    	$a->user_type = Auth::user()->user_type;
    	$a->action = $action;
    	$a->save();
    }
}
