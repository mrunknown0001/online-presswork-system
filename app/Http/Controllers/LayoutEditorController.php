<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\Article;
use App\Layout;
use App\Publication;
use App\Section;
use App\LayoutVersion;

use Illuminate\Http\Request;

class LayoutEditorController extends Controller
{
    // method use to show dashboard 
    public function dashboard()
    {
    	return view('le.dashboard');
    }


    // method use to change password
    public function changePassword()
    {
        return view('le.password-change');
    }


    // method use to save new password
    public function postChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $current_password = $request['current_password'];

        $password = $request['password'];

        $user = Auth::user();

        // check old password
        if(password_verify($current_password, $user->password)) {

            // save new password
            $user->password = bcrypt($password);
            $user->save();

            // add to activity log
            $action = 'Layout Editor Changed Password';
            GeneralController::activity_log($action);

            // return to dashboard
            return redirect()->route('le.dashboard')->with('success', 'Password Changed!');
        }

        return redirect()->back()->with('error', 'Incorrect Password!');
    }


    // method use to go to layouts managements
    public function layoutsManagement()
    {
        // get all submitted layouts
        $layouts = Layout::where('active', 1)
                    ->where('eic_denied', 0)
                    ->orderBy('eic_approved', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

    	return view('le.layouts', ['layouts' => $layouts]);
    }


    // method use to get publication
    public function getPublication($publicationId)
    {
        $publication = Publication::findorfail($publicationId);


        if(count($publication->open_publication) > 0) {
            $ids = [];

            foreach($publication->open_publication as $op) {
                $ids[] = ['id' => $op->section_id];
            }

            return $sections = Section::find($ids);
        }
    }


    // method use to add layout
    public function addLayout()
    {
        // publication
        $publications = Publication::orderBy('name', 'asc')->get();

    	return view('le.layout-add', ['publications' => $publications]);
    }


    // method use to add and save layout submitted 
    public function postAddLayout(Request $request)
    {
        $request->validate([
            'layout' => 'required|file|mimes:jpeg,jpg,pdf|max:5120',
            'publication' => 'required',
            'section' => 'required'
        ]);

        $publication_id = $request['publication'];
        $section_id = $request['section'];

        // get current time and append the upload file extension to it,
        // then put that name to $photoName variable.
        $photoname = 'FILE_' . time().'.'.$request->layout->getClientOriginalExtension();

        /*
        talk the select file and move it public directory and make avatars
        folder if doesn't exsit then give it that unique name.
        */
        $request->layout->move(public_path('uploads/layouts'), $photoname);

        // add to layout
        $layout = new Layout();
        $layout->filename = $photoname;
        $layout->publication_id = $publication_id;
        $layout->section_id = $section_id;
        $layout->save();

        // add to layout version
        $lv = new LayoutVersion();
        $lv->version = 1.0;
        $lv->layout_id = $layout->id;
        $lv->user_id = Auth::user()->id;
        $lv->save();

        // add to activity log
        $action = 'Layout Editor Uploaded new Layout';
        GeneralController::activity_log($action);

        // return to layouts management
        return redirect()->route('le.layouts.management')->with('success', 'Layout Submitted!');
    }



    // method use to view denied layout
    public function deniedLayout()
    {
        $layouts = Layout::where('active', 1)
                    ->where('eic_denied', 1)
                    ->paginate(5);

    	return view('le.layout-denied', ['layouts' => $layouts]);
    }


    // method use to resubmit denied layout
    public function resubmitLayout($id = null)
    {

        $layout = Layout::findorfail($id);

        // check here
        if($layout->eic_denied != 1) {
            return redirect()->back()->with('error', 'Please Try Again Later!');
        }

        return view('le.layout-resubmit', ['layout' => $layout]);
    }


    // method use to save resubmit 
    public function postResubmitLayout(Request $request)
    {
        $request->validate([
            'layout' => 'required|file|mimes:jpeg,jpg,pdf|max:5120',
            'id' => 'required'
        ]);

        $id = $request['id'];

        $layout = Layout::findorfail($id);

        $request->layout->move(public_path('uploads/layouts'), $layout->filename);

        // add to layout
        $layout->filename = $layout->filename;
        $layout->le_comply = 1;
        $layout->comply_date = now();
        $layout->save();

        // add to activity log
        $action = 'Layout Editor Re-Submitted Layout';
        GeneralController::activity_log($action);

        // return to layouts management
        return redirect()->route('le.layouts.management')->with('success', 'Layout Re-Submitted!');


    }


    // method use shwo approved articles
    public function articles()
    {
        // get all articles approved by editor in cheif
        $articles = Article::where('eic_proofread', 1)
                            ->orderBy('eic_proofread_date', 'desc')
                            ->paginate(10);

        return view('le.articles', ['articles' => $articles]);
    }



    // method use to download
    public function downloadArticle($id = null)
    {
        $article = Article::findorfail($id);

        if($article->eic_proofread != 1) {
            return redirect()->back()->with('error', 'Please Try Again Later!');
        }

        $filename = $article->title . '.txt';

        Storage::put($filename, $article->content);

        $action = 'Layout Editor Downloaded Article ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return response()->download(storage_path("app/{$filename}"));
    }
}
