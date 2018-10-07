<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\ActivityLog;
use App\Section;
use App\Article;

class AdminController extends Controller
{
    // method use to go to admin dashboard
    public function dashboard()
    {
    	return view('admin.dashboard');
    }


    // method use to show section management
    public function sectionManagement()
    {
        $sections = Section::orderBy('name', 'asc')
                        ->paginate(15);

        return view('admin.section', ['sections' => $sections]);
    }


    // method use to show articles management
    public function articleManagement()
    {
        $articles = Article::orderBy('create_at', 'asc')
                        ->paginate(15);

        return view('admin.article', ['articles' => $articles]);
    }


    // method use to show activity log
    // audit trail
    public function activityLog()
    {
    	$logs = ActivityLog::orderBy('created_at', 'desc')
    				->paginate(15);

    	return view('admin.activity-log', ['logs' => $logs]);
    }
}
