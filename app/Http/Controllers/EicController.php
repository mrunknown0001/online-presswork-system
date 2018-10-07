<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EicController extends Controller
{
    // method use to go to dashboard
	public function dashboard()
	{
		return view('eic.dashboard');
	}
}
