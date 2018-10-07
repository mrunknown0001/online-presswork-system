<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GeneralController extends Controller
{
    
    public function logout()
    {
    	// add activity log for logout

    	Auth::logout();

    	return 'Logout Function';
    }


    public function activity_log()
    {

    }
}
