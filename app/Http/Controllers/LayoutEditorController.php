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

        $action = 'Section Editor Downloaded Article ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return response()->download(storage_path("app/{$filename}"));
    }
}
