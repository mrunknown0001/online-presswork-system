<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\Article;
use App\Layout;

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
        // get all submitted layouts
        $layouts = Layout::where('active', 1)
                    ->where('eic_denied', 0)
                    ->orderBy('eic_approved', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

    	return view('le.layouts', ['layouts' => $layouts]);
    }


    // method use to add layout
    public function addLayout()
    {
    	return view('le.layout-add');
    }


    // method use to add and save layout submitted 
    public function postAddLayout(Request $request)
    {
        $request->validate([
            'layout' => 'required|file|image|mimes:jpeg|max:5120'
        ]);

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
        $layout->save();

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
