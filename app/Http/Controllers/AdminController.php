<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // method use to go to admin dashboard
    public function dashboard()
    {
    	return view('admin.dashboard');
    }
}
