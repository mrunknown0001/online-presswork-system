<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutEditorController extends Controller
{
    // method use to show dashboard 
    public function dashboard()
    {
    	return view('le.dashboard');
    }
}
