<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

use App\Http\Controllers\GeneralController;

use App\Article;
use App\ArticleVersion;
use App\ArticleVersionContent;
use App\ProofreadArticle;

class SectionEditorController extends Controller
{

    public function dashboard()
    {
    	return view('se.dashboard');
    }


    // method use to change password
    public function changePassword()
    {
        return view('se.password-change');
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
            $action = 'Section Editor Changed Password';
            GeneralController::activity_log($action);

            // return to dashboard
            return redirect()->route('se.dashboard')->with('success', 'Password Changed!');
        }

        return redirect()->back()->with('error', 'Incorrect Password!');
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

        // return $article->content;

        return view('se.article-view-edit', ['article' => $article]);

    }

    // method to save proofread article to image
    public function saveImageCanvas(Request $request)
    {
        $img = $request['imgBase64'];
        $article_id = $request['article_id'];

        $article = Article::findorfail($article_id);
        
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $filename = uniqid() . '.png';
        $file = "uploads/canvas/" . $filename;
        $success = file_put_contents($file, $data);

        // check if there is proofread in the article
        $check = ProofreadArticle::where('article_id', $article_id)->whereActive(1)->first();

        if(!empty($check)) {
            $check->active = 0;
            $check->delete();
        }

        // add record here attaching document to the article
        $proofread = new ProofreadArticle();
        $proofread->filename = $filename;
        $proofread->article_id = $article_id;
        $proofread->section_editor_id = Auth::user()->id;
        $proofread->save();

        // mark se deny
        $article->se_deny = 1;
        $article->se_deny_date = now();
        $article->save();

        // add article version content
        
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

        if($article->version->version >= 2) {
            $article->version->version += 0.1;
        }
        else {
            $article->version->version = 2;
        }

        $article->version->save();

        $av = new ArticleVersion();
        $av->version = $article->version->version;
        $av->article_id = $article->id;
        $av->user_id = Auth::user()->id;
        $av->save();

        // new article version content
        $avc = new ArticleVersionContent();
        $avc->article_id = $article->id;
        $avc->version = $av->version;
        $avc->content = $article->content;
        $avc->save();

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

        $filename = $article->title . '.html';

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
        $article->eic_deny = 0;
        $article->save();

        $article->version->version += 0.1;
        $article->version->save();

        // new article version content
        $avc = new ArticleVersionContent();
        $avc->article_id = $article->id;
        $avc->version = $article->version->version;
        $avc->content = $article->content;
        $avc->save();

        // add to activity log
        $action = 'Section Editor Resubmitted Article to EIC';
        GeneralController::activity_log($action);

        // return to articles
        return redirect()->route('se.articles')->with('success', 'Article Resubmitted!');
    }



    // method use to view all versions of articles
    public function articleVersions($id)
    {
        $article = Article::findorfail($id);

        return view('se.article-versions', ['article' => $article]);
    }


    // method use to view content of article version
    public function viewArticleVersionContent($id)
    {
        $avc = ArticleVersionContent::findorfail($id);

        return view('se.article-version-content', ['avc' => $avc]);
    }


    // method use to view proofreaded articles
    public function proofreadedArticles()
    {
        // get all proofreaded article
        $proofreaded = Auth::user()->se_proofreaded;

        return view('se.articles-proofreaded', ['proofreaded' => $proofreaded]);
    }


    // method use to download proofreaded file
    public function downloadProofreaded($id)
    {
        $proof = ProofreadArticle::find($id);

        $pathToFile = public_path('/uploads/canvas/') . $proof->filename;

        return response()->download($pathToFile);
    }

}
