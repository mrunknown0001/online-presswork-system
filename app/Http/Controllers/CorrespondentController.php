<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Controllers\GeneralController;

use App\User;
use App\Section;
use App\Article;
use App\ArticleAttrib;

class CorrespondentController extends Controller
{
    //
    public function dashboard()
    {
    	return view('correspondent.dashboard');
    }


    // method use to show articles 
    public function articles()
    {
    	$articles = Article::where('correspondent_id', Auth::user()->id)
    					->where('active', 1)
                        ->orderBy('created_at', 'desc')
    					->paginate(10);

    	return view('correspondent.articles', ['articles' => $articles]);
    }


    // method use to add new article
    public function newArticle()
    {
    	// get all active sections
    	$sections = Section::where('active', 1)
    					->orderBy('name', 'asc')
    					->get();

    	return view('correspondent.article-new', ['sections' => $sections]);
    }


    // method use to save new article
    public function postNewArticle(Request $request)
    {
    	$request->validate([
    		'section' => 'required',
    		'title' => 'required',
    		'content' => 'required'
    	]);

    	$section = $request['section'];
    	$title = $request['title'];
    	$content = $request['content'];

    	// save to articles marks submitted
    	$article = new Article();
    	$article->correspondent_id = Auth::user()->id;
    	$article->title = $title;
    	$article->content = $content;
    	$article->section_id = $section;
    	$article->save();
    	
    	// add to articles attrib
    	$attrib = new ArticleAttrib();
    	$attrib->article_id = $article->id;
    	$attrib->save();

    	// add to activity log
    	$action = 'Correspondent Submitted New Article: ' . ucwords($article->title);
        GeneralController::activity_log($action);

    	// return to articles with success message
    	return redirect()->route('correspondent.articles')->with('success', 'Article Submitted!');
    }


    // method use to view article
    public function viewArticle($id = null)
    {
        $c = Auth::user();

        $article = Article::findorfail($id);

        if($article->correspondent_id != $c->id) {
            return redirect()->back()->with('error', 'Please Try Again!');
        }
    }
}
