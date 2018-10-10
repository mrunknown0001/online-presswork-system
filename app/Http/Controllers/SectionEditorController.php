<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                            ->where('se_deny', 0)
    						->paginate(10);

    	return view('se.articles', ['articles' => $articles, 'sa' => $section_assign]);
    }


    // method use to view approved articles
    public function approvedArticles()
    {
        $se = Auth::user();

        // find all articles se_approved
        $articles = Article::where('se_proofread', 1)
                        ->where('se_id', $se->id)
                        ->where('eic_deny', 0)
                        ->where('active', 1)
                        ->orderBy('se_proofread_date', 'desc')
                        ->paginate(10);

        // send to view
        return view('se.articles-approved', ['articles' => $articles]);
    }


    // method use to view article
    public function viewArticle($id = null)
    {
        $article = Article::findorfail($id);

        $section_assign = Auth::user()->section_assignment->section;

        if($article->section_id != $section_assign->id || $article->se_proofread == 1) {
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

        return view('se.article-view-edit', ['article' => $article]);

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
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $id = $request['id'];
        $title = $request['title'];
        $content = $request['content'];

        $section_assign = Auth::user()->section_assignment->section;

        $article = Article::findorfail($id);

        // check if section is applicable to section editor
        if($article->section_id != $section_assign->id) {
            return redirect()->back()->with('error', 'Please Try Again Later!');
        }


        // mark as se edited 
        $article->se_proofread = 1;
        $article->se_id = Auth::user()->id;
        $article->se_proofread_date = now();
        $article->save();

        // add to activty log
        $action = 'Section Editor Approved Article from ' . ucwords($article->user->firstname . ' ' . $article->user->lastname) . ': ' . ucwords($article->title);
        GeneralController::activity_log($action);

        // return to approved articles
        return redirect()->route('se.approved.articles')->with('sucess', 'Article Approved!');
    }


    // method use to deny article
    public function postDenyArticle(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'comment' => 'required'
        ]);

        $id = $request['id'];
        $comment = $request['comment'];

        $section_assign = Auth::user()->section_assignment->section;

        $article = Article::findorfail($id);

        // check if section is applicable to section editor
        if($article->section_id != $section_assign->id) {
            return redirect()->back()->with('error', 'Please Try Again Later!');
        }

        $article->se_id = Auth::user()->id;
        $article->se_deny = 1;
        $article->se_comment = $comment;
        $article->se_deny_date = now();
        $article->save();

        $action = 'Section Editor Denied Article from ' . ucwords($article->user->firstname . ' ' . $article->user->lastname) . ': ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return redirect()->route('se.articles')->with('success', 'Article Denied!');
    }


    // method use to view only 
    public function viewOnlyArticle($id = null)
    {
        $article = Article::findorfail($id);

        $se = Auth::user();

        if($article->se_id != $se->id) {
            return redirect()->back()->with('error', 'Oops! Please Try Again Later!');
        }

        return view('se.article-view', ['article' => $article]);
    }


    // method use to download
    public function downloadArticle($id = null)
    {
        $article = Article::findorfail($id);

        $filename = $article->title . '.txt';

        Storage::put($filename, $article->content);

        $action = 'Section Editor Downloaded Article ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return response()->download(storage_path("app/{$filename}"));
    }


    // method use to view denied articles
    public function viewDeniedArticle()
    {
        $section = Auth::user()->section_assignment->section;

        $articles = Article::where('section_id', $section->id)
                            ->where('eic_deny', 1)
                            ->where('se_comply', 0)
                            ->where('active', 1)
                            ->paginate(10);

        return view('se.articles-denied', ['articles' => $articles]);
    }


    // method use to update article
    public function updateArticle($id = null)
    {
        $article = Article::findorfail($id);

        return view('se.article-update', ['article' => $article]);
    }


    // method use to save update on article
    public function postUpdateArticle(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $id = $request['id'];

        $title = $request['title'];
        $content = $request['content'];

        $article = Article::findorfail($id);

        // save article
        $article->se_comply = 1;
        $article->save();

        // add to activity log
        $action = 'Section Editor Resubmitted Article to EIC';
        GeneralController::activity_log($action);

        // return to articles
        return redirect()->route('se.articles')->with('success', 'Article Resubmitted!');
    }

}
