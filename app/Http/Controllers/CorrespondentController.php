<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Controllers\GeneralController;

use App\User;
use App\Section;
use App\Article;
use App\ArticleVersion;
use App\Publication;
use App\OpenPublication;

class CorrespondentController extends Controller
{
    //
    public function dashboard()
    {
    	return view('correspondent.dashboard');
    }


    // method use to change password
    public function changePassword()
    {
        return view('correspondent.password-change');
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
            $action = 'Correspondent Changed Password';
            GeneralController::activity_log($action);

            // return to dashboard
            return redirect()->route('correspondent.dashboard')->with('success', 'Password Changed!');
        }

        return redirect()->back()->with('error', 'Incorrect Password!');
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
        $publications = Publication::orderBy('name', 'asc')->get();

    	// get all active sections
    	$sections = Section::where('active', 1)
    					->orderBy('name', 'asc')
    					->get();

    	return view('correspondent.article-new', ['publications' => $publications, 'sections' => $sections]);
    }


    // method use to get sections in open publication
    public function subjectsInPublication($id)
    {
        $publication = Publication::find($id);

        if(!empty($publication)) {
            $open = OpenPublication::where('publication_id', $id)->get();

            if(count($open) > 0) {
                $section = array();
                foreach($open as $p) {
                    $section[] = [
                        'id' => $p->section_id,
                        'name' => $p->section->name
                    ];
                }

                return $section;
            }
        }

    }


    // method use to save new article
    public function postNewArticle(Request $request)
    {
    	$request->validate([
            'publication' => 'required',
    		'section' => 'required',
    		'title' => 'required',
    		'content' => 'required'
    	]);

        $publication = $request['publication'];
    	$section = $request['section'];
    	$title = $request['title'];
    	$content = $request['content'];

    	// save to articles marks submitted
    	$article = new Article();
    	$article->correspondent_id = Auth::user()->id;
    	$article->title = $title;
    	$article->content = $content;
        $article->publication_id = $publication;
    	$article->section_id = $section;
    	$article->save();

        $av = new ArticleVersion();
        $av->version = 1.0;
        $av->article_id = $article->id;
        $av->user_id = Auth::user()->id;
        $av->save();

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

        return view('correspondent.article-view', ['article' => $article]);
    }


    // method use to edit denied article
    public function editDenyArticle($id = null)
    {
        $article = Article::findorfail($id);

        $co = Auth::user();

        if($article->correspondent_id != $co->id || $article->se_deny != 1) {
            return redirect()->back()->with('notice', 'Please Reaload This Page and Try Again!');
        }

        return view('correspondent.article-edit-deny', ['article' => $article]);
    }


    // method use to update denied article
    public function postUpdateArticle(Request $request)
    {
        $id = $request['id'];

        $article = Article::findorfail($id);

        $co = Auth::user();

        if($article->correspondent_id != $co->id || $article->se_deny != 1) {
            return redirect()->back()->with('notice', 'Please Reaload This Page and Try Again!');
        }

        // save article
        $article->se_deny = 0;
        $article->correspondent_comply = 1;
        $article->save();

        // updaate version
        $article->version->version += 0.1;
        $article->version->save();

        // add activity log
        $action = 'Correspondent Updated Article: ' . ucwords($article->title);
        GeneralController::activity_log($action);

        // return to articles
        return redirect()->route('correspondent.articles')->with('success', 'Article Update & Submitted!');
        
    }



    // method use to view article versions
    public function articleVersions($id)
    {
        $article = Article::findorfail($id);

        if($article->correspondent_id != Auth::user()->id) {
            return abort(404);
        }
    }
}
