<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionEditorController extends Controller
{
    public function dashboard()
    {
    	return view('se.dashboard');
    }
}
