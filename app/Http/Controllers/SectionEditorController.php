<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\GeneralController;

use App\Article;

class SectionEditorController extends Controller
{

    public function dashboard()
    {
    	return view('se.dashboard');
    }


    // method use to show articles
    public function articles()
    {
        $section_assign = Auth::user()->section_assignment->section;

    	// get all articles with under the section assigned
    	$articles = Article::where('section_id', $section_assign->id)
    						->where('active', 1)
    						->where('se_proofread', 0)
    						->paginate(10);

    	return view('se.articles', ['articles' => $articles, 'sa' => $section_assign]);
    }


    // method use to view article
    public function viewArticle($id = null)
    {
        $article = Article::findorfail($id);

        $section_assign = Auth::user()->section_assignment->section;

        if($article->section_id != $section_assign->id) {
            return redirect()->back()->with('error', 'Please Try Again Later!');
        }

        // check if articles is viewing by another user
        if($article->viewing == 1 && $article->viewing_by != Auth::user()->id) {
            return redirect()->back()->with('notice', 'Article is Viewing by another user.');
        }

        // make article as viewing
        $article->viewing = 1;
        $article->viewing_by = Auth::user()->id;
        $article->save();

        return view('se.article-view', ['article' => $article]);

    }

    // method use to close viewing article
    public function closeViewArticle($id = null)
    {
        $article = Article::findorfail($id);
        $article->viewing = 0;
        $article->viewing_by = null;
        $article->save();

        return redirect()->route('se.articles');
    }


    // method use to approve article
    public function postApproveArticle(Request $request)
    {
        return $request;

        // check if section is applicable to section editor

        // mark as se edited
    }
}
