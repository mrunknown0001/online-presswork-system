<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\GeneralController;

use App\User;

class EicController extends Controller
{
    // method use to go to dashboard
	public function dashboard()
	{
		return view('eic.dashboard');
	}


	// method use to go to layout editor management
	public function layoutEditorManagement()
	{
		$le = User::where('user_type', 3)
				->where('active', 1)
				->get();

		return view('eic.le', ['le' => $le]);
	}


	// method use to add layout editor
	public function addLayoutEditor()
	{
		return view('eic.le-add');
	}


	// method use to save new layout editor
	public function postAddLayoutEditor(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required|unique:users'
		]);

		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];

		// add to users table
		$user = new User();
		$user->firstname = $firstname;
		$user->lastname = $lastname;
		$user->username = $username;
		$user->password = bcrypt('password');
		$user->user_type = 3;
		$user->save();

		// add activity log
        $action = 'Editor In Chief Added Layout Editor  ' . ucwords($firstname . ' ' . $lastname);
        GeneralController::activity_log($action);

		// return to le management
		return redirect()->route('eic.layout.editor.management')->with('success', 'Added New Layout Editor');
	}


	// method use to update layout editor
	public function updateLayoutEditor($id = null)
	{
		$le = User::findorfail($id);

		if($le->user_type != 3) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		return view('eic.le-update', ['le' => $le]);
	}


	// method use to save update layout editor
	public function postUpdateLayoutEditor(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required'
		]);

		$id = $request['id'];
		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];

		$le = User::findorfail($id);

		if($le->user_type != 3) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		// check username if exists
		$check_username = User::where('username', $username)
								->first();

		if(count($check_username) > 0) {
			if($le->id != $check_username->id) {
				return redirect()->back()->with('error', 'Username already exists!');
			}
		}

		$le->firstname = $firstname;
		$le->lastname = $lastname;
		$le->username = $username;
		$le->save();

		// add activity log
		$action = 'Editor In Chief Updated Layout Editor  ' . ucwords($firstname . ' ' . $lastname);
        GeneralController::activity_log($action);

		// return to layout editor management
        return redirect()->route('eic.layout.editor.management')->with('success', 'Updated Layout Editor');

	}


	// method use to go to section editor management
	public function sectioneditorManagement()
	{
		return view('eic.se');
	}


	// method use to go to correspondent management
	public function correspondentManagement()
	{
		return view('eic.correspondent');
	}


	// method use to go to article management 
	public function articleManagement()
	{
		return view('eic.article');
	}


	// method use to go to layouts management
	public function layoutManagement()
	{
		return view('eic.layout');
	}
}
