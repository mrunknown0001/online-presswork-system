<?php

namespace App\Http\Controllers;
use Auth;


use Illuminate\Http\Request;

class LayoutEditorController extends Controller
{
    // method use to show dashboard 
    public function dashboard()
    {
    	return view('le.dashboard');
    }


    // method use to go to layouts managements
    public function layoutsManagement()
    {
    	return view('le.layouts');
    }


    // method use to add layout
    public function addLayout()
    {
    	return view('le.layout-add');
    }



    // method use to view denied layout
    public function deniedLayout()
    {
    	return view('le.layout-denied');
    }
}
