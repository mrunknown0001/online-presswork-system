<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyActivitySubmit;

use App\ActivityLog;
use App\Activity;
use App\ActivityEntry;

class GeneralController extends Controller
{
	public function landing()
	{
		$activities = Activity::where('active', 1)
							->orderBy('created_at', 'asc')
							->get();

		return $this->check_auth('landing', $activities);
	}

	public function login()
	{
		return $this->check_auth('login');
	}
    
	public function check_auth($view, $value = null)
	{
		if(Auth::check()) {
			if(Auth::user()->user_type == 1) {
				return redirect()->route('admin.dashboard');
			}
			else if(Auth::user()->user_type == 2) {
				return redirect()->route('eic.dashboard');
			}
			else if(Auth::user()->user_type == 3) {
				return redirect()->route('le.dashboard');
			}
			else if(Auth::user()->user_type == 4) {
				return redirect()->route('se.dashboard');
			}
			else if(Auth::user()->user_type == 5) {
				return redirect()->route('correspondent.dashboard');
			}
		}

		return view($view, ['value' => $value]);
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


    // method use to submit entry in activity
    public function submitEntry($id = null)
    {
    	// return view to submit entry
    	$activity = Activity::findorfail($id);

    	if($activity->active == 0) {
    		return redirect()->back()->with('error', 'Please Try Again Later!');
    	}

    	return view('activity-entry', ['activity' => $activity]);
    }


    // method use to save submitte entry
    public function postSubmitEntry(Request $request)
    {
    	$request->validate([
    		'entry' => 'required|file|mimes:pdf|max:20480',
            'email' => 'required|email'
    	]);

    	$id = $request['id'];
    	$name = $request['name'];
        $email = $request['email'];

        $activity = Activity::findorfail($id);

    	// move to entry folder
        $entry_file = 'FILE_' . time().'.'.$request->entry->getClientOriginalExtension();

        /*
        talk the select file and move it public directory and make avatars
        folder if doesn't exsit then give it that unique name.
        */
        $request->entry->move(public_path('uploads/entry'), $entry_file);

    	// add to entry
    	$entry = new ActivityEntry();
    	$entry->activity_id = $id;
    	$entry->fullname = $name;
    	$entry->filename = $entry_file;
        $entry->email = $email;
    	$entry->save();

        // send email
        Mail::to($email)->send(new NotifyActivitySubmit($activity));

    	// return back with success message
    	return redirect()->route('landing')->with('success', 'Entry Submitted. Thank you!');
    }
}
