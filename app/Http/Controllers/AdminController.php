<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Controllers\GeneralController;

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
        $sections = Section::where('active', 1)
                        ->orderBy('name', 'asc')
                        ->paginate(15);

        return view('admin.section', ['sections' => $sections]);
    }


    // method use to add section
    public function addSection()
    {
        return view('admin.section-add');
    }


    // method use to save new section
    public function postAddSection(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        // save section to database
        $section = new Section();
        $section->name = $name;
        $section->description = $description;
        $section->save();

        // add activity log
        $action = 'Admin Added New Section Name: ' . ucwords($name);
        GeneralController::activity_log($action);

        // return to section management
        return redirect()->route('admin.section.management')->with('success', 'New Section Added!');

    }


    // method use to update section
    public function updateSection($id = null)
    {
        $section = Section::findorfail($id);

        // return to view for update of section
        return view('admin.section-update', ['section' => $section]);
    }


    // method use to save update section
    public function postUpdateSection(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $id = $request['id'];

        $section = Section::findorfail($id);
        $section->name = $name;
        $section->description = $description;
        $section->save();

        // add activity log
        $action = 'Admin Update Section Name: ' . ucwords($name);
        GeneralController::activity_log($action);

        // return to sections
        return redirect()->route('admin.section.management')->with('success', 'Section Updated!');
    }


    // method use to remove section
    // make section active to 0 
    public function postRemoveSection(Request $request)
    {
        $id = $request['id'];

        $section = Section::findorfail($id);
        $section->active = 0;
        $section->save();

        return redirect()->back()->with('success', 'Section ' . ucwords($section->name) . ' removed.');
    }


    // method use to show articles management
    public function articleManagement()
    {
        $articles = Article::orderBy('create_at', 'asc')
                        ->paginate(15);

        return view('admin.article', ['articles' => $articles]);
    }


    // method use to publish and deny articles 
    public function publish()
    {
        return view('admin.publish');
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
