<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyActivityWinner;

use App\Http\Controllers\GeneralController;

use App\User;
use App\Section;
use App\SectionEditorAssignment;
use App\Article;
use App\ArticleVersion;
use App\ArticleVersionContent;
use App\Layout;
use App\Activity;
use App\ActivityEntry;
use App\Publication;
use App\OpenPublication;

class EicController extends Controller
{
    // method use to go to dashboard
	public function dashboard()
	{
		$approved_layouts = Layout::where('eic_approved', 1)->get();
		$approved_articles = Article::where('eic_proofread', 1)->get();

		return view('eic.dashboard', ['approved_layouts' => $approved_layouts, 'approved_articles' => $approved_articles]);
	}


	// method use to change password
	public function changePassword()
	{
		return view('eic.password-change');
	}


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
            $action = 'Editor In Chief Changed Password';
            GeneralController::activity_log($action);

            // return to dashboard
            return redirect()->route('eic.dashboard')->with('success', 'Password Changed!');
        }

        return redirect()->back()->with('error', 'Incorrect Password!');
    }


    // method use to reset password of user
    public function resetPasswordReset($id = null)
    {
    	if($id == 1 || $id == 2) {
    		return redirect()->back()->with('error', 'Please Try Again Later!');
    	}

    	$user = User::findorfail($id);
    	$user->password = bcrypt('password');
    	$user->save();

        $action = 'Editor In Chief reset password of  ' . ucwords($user->firstname . ' ' . $user->lastname);
        GeneralController::activity_log($action);

        return redirect()->back()->with('success', 'Password for ' . ucwords($user->firstname . ' ' . $user->lastname) . ' has been successfully reset to "password"');

    }


	// method use to go to layout editor management
	public function layoutEditorManagement()
	{
		$le = User::where('user_type', 3)
				->where('active', 1)
				->orderBy('lastname', 'asc')
				->get();

		return view('eic.le', ['le' => $le]);
	}


	// method use to add layout editor
	public function addLayoutEditor()
	{
		return view('eic.le-add');
	}


	// method use to save new layout editor
	public function postAddLayoutEditor(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required|unique:users'
		]);

		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];

		// add to users table
		$user = new User();
		$user->firstname = $firstname;
		$user->lastname = $lastname;
		$user->username = $username;
		$user->password = bcrypt('password');
		$user->user_type = 3;
		$user->save();

		// add activity log
        $action = 'Editor In Chief Added Layout Editor  ' . ucwords($firstname . ' ' . $lastname);
        GeneralController::activity_log($action);

		// return to le management
		return redirect()->route('eic.layout.editor.management')->with('success', 'Added New Layout Editor');
	}


	// method use to update layout editor
	public function updateLayoutEditor($id = null)
	{
		$le = User::findorfail($id);

		if($le->user_type != 3) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		return view('eic.le-update', ['le' => $le]);
	}


	// method use to save update layout editor
	public function postUpdateLayoutEditor(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required'
		]);

		$id = $request['id'];
		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];

		$le = User::findorfail($id);

		if($le->user_type != 3) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		// check username if exists
		$check_username = User::where('username', $username)
								->first();

		if(count($check_username) > 0) {
			if($le->id != $check_username->id) {
				return redirect()->back()->with('error', 'Username already used!');
			}
		}

		$le->firstname = $firstname;
		$le->lastname = $lastname;
		$le->username = $username;
		$le->save();

		// add activity log
		$action = 'Editor In Chief Updated Layout Editor  ' . ucwords($firstname . ' ' . $lastname);
        GeneralController::activity_log($action);

		// return to layout editor management
        return redirect()->route('eic.layout.editor.management')->with('success', 'Updated Layout Editor');

	}


	// method use to remove layout editor
	public function postRemoveLayoutEditor(Request $request)
	{
		$id = $request['id'];

		$le = User::findorfail($id);

		if($le->user_type != 3) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		$le->active = 0;
		$le->save();

		// add activity log
		$action = 'Editor In Chief Removed Layout Editor  ' . ucwords($le->firstname . ' ' . $le->lastname);
        GeneralController::activity_log($action);

        return redirect()->route('eic.layout.editor.management')->with('success', 'Layout Editor Removed!');

	}


	// method use to go to section editor management
	public function sectionEditorManagement()
	{
		$se = User::where('user_type', 4)
				->where('active', 1)
				->orderBy('lastname', 'asc')
				->get();

		return view('eic.se', ['se' => $se]);
	}


	// method use to add section editor
	public function addSectionEditor()
	{
		// get all section to assign for section editor
		$sections = Section::where('active', 1)
						->orderBy('name', 'asc')
						->get(['id', 'name']);

		return view('eic.se-add', ['sections' => $sections]);
	}


	// method use to save new section editor
	public function postAddSectionEditor(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required|unique:users',
			'section' => 'required'
		]);

		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];
		$section = $request['section'];

		// check if there is a section editor assiged in section
		$sect = Section::findorfail($section);

		$check_section_assignment = SectionEditorAssignment::where('section_id', $section)->first();

		if(!empty($check_section_assignment)) {
			return redirect()->back()->with('error', 'Section Already Assigned!');
		}

		// add in users table and section editor assignments
		$user = new User();
		$user->firstname = $firstname;
		$user->lastname = $lastname;
		$user->username = $username;
		$user->password = bcrypt('password');
		$user->user_type = 4;
		$user->save();

		$assign = new SectionEditorAssignment();
		$assign->user_id = $user->id;
		$assign->section_id = $section;
		$assign->save();

		// add activity log
		$action = 'Editor In Chief Added New Section Editor  ' . ucwords($user->firstname . ' ' . $user->lastname);
        GeneralController::activity_log($action);

		// return to section editor management
		return redirect()->route('eic.section.editor.management')->with('success', 'Added New Section Editor');

	}


	// method use to update section editor
	public function updateSectionEditor($id = null)
	{
		$se = User::findorfail($id);

		if($se->user_type != 4) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		$sections = Section::where('active', 1)
						->orderBy('name', 'asc')
						->get(['id', 'name']);

		// return to update form
		return view('eic.se-update', ['se' => $se, 'sections' => $sections]);
	}


	// method use to save udpate on section editor
	public function postUpdateSectionEditor(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required',
			'section' => 'required'
		]);

		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];
		$section = $request['section'];


		$id = $request['id'];

		$se = User::findorfail($id);

		if($se->user_type != 4) {
			return redirect()->back()->with('error', 'Please Reload This Page And Try Again Later!');
		}

		// check username
		$check_username = User::where('username', $username)
								->first();

		if(count($check_username) > 0) {
			if($se->id != $check_username->id) {
				return redirect()->back()->with('error', 'Username already used!');
			}
		}

		// check if there is a section editor assiged in section
		$sect = Section::findorfail($section);

		$check_section_assignment = SectionEditorAssignment::where('section_id', $section)->first();

		if(count($check_section_assignment) > 0) {
			if($check_section_assignment->user_id != $id)
			return redirect()->back()->with('error', 'Section Already Assigned!');
		}

		

		$se->firstname = $firstname;
		$se->lastname = $lastname;
		$se->username = $username;
		$se->save();

		$se->section_assignment->section_id = $section;
		$se->section_assignment->save();

		$action = 'Editor In Chief Updated Section Editor  ' . ucwords($firstname . ' ' . $lastname);
        GeneralController::activity_log($action);

		// return to layout editor management
        return redirect()->route('eic.section.editor.management')->with('success', 'Updated Section Editor');

	}


	// method use to remove section editor
	public function postRemoveSectionEditor(Request $request)
	{
		$id = $request['id'];

		$se = User::findorfail($id);

		if($se->user_type != 4) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		$se->active = 0;
		$se->save();

		$action = 'Editor In Chief Removed Section Editor  ' . ucwords($se->firstname . ' ' . $se->lastname);
        GeneralController::activity_log($action);

		// return to layout editor management
        return redirect()->route('eic.section.editor.management')->with('success', 'Removed Section Editor');
	}


	// method use to go to correspondent management
	public function correspondentManagement()
	{
		$correspondents = User::where('user_type', 5)
							->where('active', 1)
							->orderBy('lastname', 'asc')
							->get();

		return view('eic.correspondent', ['correspondents' => $correspondents]);
	}


	// method use to add correspondent
	public function addCorrespondent()
	{
		return view('eic.correspondent-add');
	}


	// method use to save new correspondent
	public function postAddCorrespondent(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required|unique:users'
		]);

		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];

		// add user with the user type of 5
		$user = new User();
		$user->firstname = $firstname;
		$user->lastname = $lastname;
		$user->username = $username;
		$user->password = bcrypt('password');
		$user->user_type = 5;
		$user->save();

		// add activity log
		$action = 'Editor In Chief Added New Correspondent  ' . ucwords($user->firstname . ' ' . $user->lastname);
        GeneralController::activity_log($action);

		// return to correspondent
		return redirect()->route('eic.correspondent.management')->with('success', 'New Correspondent Added!');
	}


	// method use to update correspodent
	public function updateCorrespodent($id = null)
	{
		$c = User::findorfail($id);

		if($c->user_type != 5) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		return view('eic.correspondent-update', ['c' => $c]);
	}


	// method use to save update in correspondent
	public function postUpdateCorrespodent(Request $request)
	{
		$request->validate([
			'firstname' => 'required',
			'lastname' => 'required',
			'username' => 'required'
		]);

		$firstname = $request['firstname'];
		$lastname = $request['lastname'];
		$username = $request['username'];

		$id = $request['id'];

		$c = User::findorfail($id);

		if($c->user_type != 5) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		$check_username = User::where('username', $username)
								->first();

		if(count($check_username) > 0) {
			if($c->id != $check_username->id) {
				return redirect()->back()->with('error', 'Username already used!');
			}
		}

		$c->firstname = $firstname;
		$c->lastname = $lastname;
		$c->username = $username;
		$c->save();

        $action = 'Editor In Chief Updated Correspondent  ' . ucwords($c->firstname . ' ' . $c->lastname);
        GeneralController::activity_log($action);

		// return to le management
		return redirect()->route('eic.correspondent.management')->with('success', 'Updated Correspondent');

	}


	// method use to remove correspondent
	public function postRemoveCorrespondent(Request $request)
	{
		$id = $request['id'];

		$c = User::findorfail($id);

		if($c->user_type != 5) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		$c->active = 0;
		$c->save();

        $action = 'Editor In Chief Removed Correspondent  ' . ucwords($c->firstname . ' ' . $c->lastname);
        GeneralController::activity_log($action);

		// return to le management
		return redirect()->route('eic.correspondent.management')->with('success', 'Correspondent Removed');


	}








    // method use to show section management
    public function sectionManagement()
    {
        $sections = Section::where('active', 1)
                        ->orderBy('name', 'asc')
                        ->paginate(15);

        return view('eic.section', ['sections' => $sections]);
    }


    // method use to add section
    public function addSection()
    {
        return view('eic.section-add');
    }


    // method use to save new section
    public function postAddSection(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        // save section to database
        $section = new Section();
        $section->name = $name;
        $section->description = $description;
        $section->save();

        // add activity log
        $action = 'EIC Added New Section Name: ' . ucwords($name);
        GeneralController::activity_log($action);

        // return to section management
        return redirect()->route('eic.section.management')->with('success', 'New Section Added!');

    }


    // method use to update section
    public function updateSection($id = null)
    {
        $section = Section::findorfail($id);

        // return to view for update of section
        return view('EIC.section-update', ['section' => $section]);
    }


    // method use to save update section
    public function postUpdateSection(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $id = $request['id'];

        $section = Section::findorfail($id);
        $section->name = $name;
        $section->description = $description;
        $section->save();

        // add activity log
        $action = 'EIC Update Section Name: ' . ucwords($name);
        GeneralController::activity_log($action);

        // return to sections
        return redirect()->route('eic.section.management')->with('success', 'Section Updated!');
    }


    // method use to remove section
    // make section active to 0 
    public function postRemoveSection(Request $request)
    {
        $id = $request['id'];

        $section = Section::findorfail($id);
        $section->active = 0;
        $section->save();

        $action = 'EIC Removed Section Name: ' . ucwords($section->name);
        GeneralController::activity_log($action);

        return redirect()->back()->with('success', 'Section ' . ucwords($section->name) . ' removed.');
    }












	// method use to go to article management 
	public function articleManagement()
	{
		// get all active article with approved by section editor
		$articles = Article::where('se_proofread', 1)
						->where('eic_proofread', 0)
						->where('eic_deny', 0)
						->where('active', 1)
						->orderBy('se_proofread_date', 'asc')
						->paginate(10);

		return view('eic.article', ['articles' => $articles]);
	}


	// method use to view approved articles
	public function approvedArticles()
	{
		// get all articles with eic proofread
		$articles = Article::where('eic_proofread', 1)
						->where('active', 1)
						->paginate(10);

		return view('eic.article-approved', ['articles' => $articles]);
	}


	// method use to download article
	public function downloadArticle($id)
	{
        $article = Article::findorfail($id);

        $filename = $article->title . '.html';

        Storage::put($filename, $article->content);

        $action = 'Editor In Chief Downloaded Article ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return response()->download(storage_path("app/{$filename}"));
	}


	// method use view article
	public function viewArticle($id = null)
	{
		$article = Article::findorfail($id);

		// check if se_proofread 1 and eic_proofread 0
		if($article->se_proofread == 0 || $article->eic_proofread == 1) {
			return redirect()->back()->with('notice', 'Please Try Again Later!');
		}

		// return to view that wil edit
		return view('eic.article-edit', ['article' => $article]);

	}


	// method use to approve article by eic
	public function postApproveArticle(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'content' => 'required'
		]);

		$id = $request['id'];
		$title = $request['title'];
		$content = $request['content'];

		$article = Article::findorfail($id);

		// check if se_proofread and eic_proofread
		if($article->se_proofread == 0 || ($article->se_proofread == 1 && $article->eic_proofread == 1)) {
			return redirect()->back()->with('error', 'Please Reload This Page and Try Again!');
		}

		// mark as approve by eic
		$article->eic_proofread = 1;
		$article->eic_id = Auth::user()->id;
		$article->eic_proofread_date = now();
		$article->eic_deny = 0;
		$article->save();


        if($article->version->version >= 3) {
            $article->version->version += 0.1;
        }
        else {
            $article->version->version = 3;
        }
		$article->version->save();

		// add to article version
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

		// add to activity log
        $action = 'Editor In Chief  Approved Article Title ' . ucwords($article->title) . ' by ' . ucwords($article->user->firstname . ' ' . $article->user->lastname);
        GeneralController::activity_log($action);

		// return to approved articles in eic
		return redirect()->route('eic.approved.articles')->with('success', 'Article approved!');

	}


	// method use to view update 
	public function viewUpdateArticle($id = null)
	{
		$article = Article::findorfail($id);

		return view('eic.article-view-update', ['article' => $article]);
	}


	// method use to deny articles
	public function postDenyArticle(Request $request)
	{
		$request->validate([
			'id' => 'required',
			'comment' => 'required'
		]);

		$id = $request['id'];
		$comment = $request['comment'];

		$article = Article::findorfail($id);

		if($article->se_proofread != 1) {
			return redirect()->back()->with('notice', 'Please Reload This Page and Try Again!');
		}

		// mark as deny by eic
		$article->eic_deny = 1;
		$article->eic_comment = $comment;
		$article->eic_deny_date = now();
		$article->save();

		$article->version->version += 0.1;
		$article->version->save();

		// add to activity log
		$action = 'Editor In Chief Denied Article Title ' . ucwords($article->title);
        GeneralController::activity_log($action);

		// return to articles
		return redirect()->route('eic.article.management')->with('success', 'Article Denied!');
	}


	// method use to view denied article
	public function viewDeniedArticle()
	{
		// get all eic_deny  1 article
		$articles = Article::where('eic_deny', 1)
						->orderBy('eic_deny_date', 'asc')
						->paginate(10);

		return view('eic.article-denied', ['articles' => $articles]);

	}


	// method use to go to layouts management
	public function layoutManagement()
	{
		// get all layout submitted
		$layouts = Layout::where('active', 1)
						->where('eic_approved', 0)
						->where('eic_denied', 0)
						->paginate(5);

		return view('eic.layout', ['layouts' => $layouts]);
	}


	// method use to approve a layout
	public function approveLayout($id = null)
	{
		$layout = Layout::findorfail($id);

		// check here

		// make layout approve
		$layout->eic_approved = 1;
		$layout->eic_denied = 0;
		$layout->approved_date = now();
		$layout->save();

		$layout->version->version = 2;
		$layout->version->save();

		// add to activity log
		$action = 'Editor In Chief approved Layout';
        GeneralController::activity_log($action);

		// return to layouts management
		return redirect()->route('eic.layout.management')->with('success', 'Layout Approved');
	}


	// method use to view approved layouts
	public function viewApprovedLayouts()
	{
		$layouts = Layout::where('active', 1)
						->where('eic_approved', 1)
						->paginate(5);

		return view('eic.layout-approved', ['layouts' => $layouts]);
	}


	// method to deny layout 
	public function denyLayout($id = null)
	{
		$layout = Layout::findorfail($id);

		return view('eic.layout-deny', ['layout' => $layout]);
	}


	// method use to deny layout
	public function postDenyLayout(Request $request)
	{
		$request->validate([
			'id' => 'required',
			'comment' => 'required'
		]);

		$id = $request['id'];
		$comment = $request['comment'];

		$layout = Layout::findorfail($id);

		$layout->eic_denied = 1;
		$layout->denied_date = now();
		$layout->comment = $comment;
		$layout->save();

		// add to activity log
		$action = 'Editor In Chief denied Layout';
        GeneralController::activity_log($action);

		// return to layouts management
		return redirect()->route('eic.layout.management')->with('success', 'Layout Denied');

	}


	// method use to view denied layout
	public function deniedLayouts()
	{
		$layouts = Layout::where('active', 1)
						->where('eic_denied', 1)
						->orderBy('denied_date', 'asc')
						->paginate(5);

		return view('eic.layout-denied', ['layouts' => $layouts]);
	}



	// method use to access publications
	public function publications()
	{
		$publications = Publication::orderBy('name', 'asc')->get();

		return view('eic.publications', ['publications' => $publications]);
	}


	// method use to open publciation
	public function openPublication($id = null)
	{
		$id = decrypt($id);

		$publication = Publication::findorfail($id);

		// all section
		$sections = Section::orderBy('name', 'asc')->get();

		$open = OpenPublication::where('publication_id', $publication->id)->get(['section_id']);

		if(count($open) > 0) {

			return view('eic.publication-update-delete-open', ['publication' => $publication, 'open' => $open, 'sections' => $sections]);
		}

		return view('eic.publication-select', ['publication' => $publication, 'sections' => $sections]);
		
	}


	// method use save open publication
	public function postOpenPublication(Request $request)
	{
		$request->validate([
			'section' => 'required'
		]);

		$section_ids = $request['section'];
		$publication_id = $request['publication_id'];

		$publication = Publication::findorfail($publication_id);

		DB::table('open_publications')->where('publication_id', $publication->id)->delete();

		$open = [];

		foreach($section_ids as $s) {
			// add array to add to database
			$open[] = [
				'publication_id' => $publication->id,
				'section_id' => $s
			];
		}

		// add to databse using databse query builder
		DB::table('open_publications')->insert($open);

		$action = 'Editor in Chief Opened Publication';
        GeneralController::activity_log($action);

		return redirect()->route('eic.publications')->with('success', 'Publication Successfully Selected Sections');
	}


	// method use to close open publication
	public function closePublication($id)
	{
		$id = decrypt($id);

		DB::table('open_publications')->where('publication_id', $id)->delete();

		$action = 'Editor in Chief Closed Publication';
        GeneralController::activity_log($action);

		return redirect()->route('eic.publications')->with('success', 'Publication Successfully Closed!');
	}


	// method use in activities
	public function activities()
	{
		$activities = Activity::where('active', 1)
							->orderBy('created_at', 'desc')
							->paginate(10);

		return view('eic.activities', ['activities' => $activities]);
	}


	// method use to add activity
	public function addActivity()
	{
		return view('eic.activity-add');
	}


	// method use to save activities
	public function postAddActivity(Request $request)
	{
		$request->validate([
			'title' => 'required',
			'rules' => 'required',
			'start_date' => 'required|date',
			'end_date' => 'required|date',
			'banner' => 'required|file|image|mimes:jpeg|max:5120'
		]);

		$title = $request['title'];
		$rules = $request['rules'];
		$start_date = $request['start_date'];
		$end_date = $request['end_date'];

		if($start_date > $end_date) {
			return redirect()->back()->with('error', 'Start Date must Not Later than End Date');
		}

		if(date('m-d-Y',strtotime($start_date)) < date('m-d-Y', strtotime(now()))) {
			return redirect()->back()->with('error', 'Start Date must Not Earlier than Today');
		}

        $photoname = 'FILE_' . time().'.'.$request->banner->getClientOriginalExtension();

        /*
        talk the select file and move it public directory and make avatars
        folder if doesn't exsit then give it that unique name.
        */
        $request->banner->move(public_path('uploads/banners'), $photoname);

        // add new activity
        $act = new Activity();
        $act->eic_id = Auth::user()->id;
        $act->title = $title;
        $act->rules = $rules;
        $act->start_date = $start_date;
        $act->end_date = $end_date;
        $act->banner = $photoname;
        $act->save();

        // add to activity logs
		$action = 'Editor In Chief Added Activity';
        GeneralController::activity_log($action);

        // return to activities with success message
        return redirect()->route('eic.activities')->with('success', 'Activity Added!');

	}


	// method use to deactivate activity
	public function postDeactivateActivity(Request $request)
	{
		$id = $request['id'];

		$activity = Activity::findorfail($id);
		$activity->active = 0;
		$activity->save();

		$action = 'Editor In Chief Deactivated Activity';
        GeneralController::activity_log($action);

        // return to activities with success message
        return redirect()->route('eic.activities')->with('success', 'Activity Deactivated!');
	}



	// method use to view entries in an activity
	public function viewActivityEntries($id = null)
	{
		$activity = Activity::findorfail($id);

		$entries = ActivityEntry::where('activity_id', $activity->id)
							->orderBy('created_at', 'asc')
							->orderBy('downloaded', 'asc')
							->paginate('10');

		return view('eic.activity-entry', ['activity' => $activity, 'entries' => $entries]);
	}


	// method use to send email in activity entry
	public function sendMailActivityEntry($id = null, $eid = null)
	{
		$activity = Activity::findorfail($id);
		$entry = ActivityEntry::findorfail($eid);

		return view('eic.activity-entry-send-mail', ['activity' => $activity, 'entry' => $entry]);
	}


	// method use to send email
	public function postSendMailActivityEntry(Request $request)
	{
		$request->validate([
			'subject' => 'required',
			'content' => 'required'
		]);

		$id = $request['id'];
		$eid = $request['eid'];

		$activity = Activity::findorfail($id);
		$entry = ActivityEntry::findorfail($eid);

		$subject = $request['subject'];
		$content = $request['content'];

		// send email message
		Mail::to($entry->email)->send(new NotifyActivityWinner($subject, $content));

		// save to activity log
		$action = 'Editor In Chief Send Email to Activity Entry Winner';
        GeneralController::activity_log($action);

		// return to activities
		return redirect()->route('eic.activities')->with('success', 'Email Sent Successfully!');
	}


	// method use to download pdf entry file
	public function downloadActivityEntry($a_id = null, $e_id = null)
	{
		$activity = Activity::findorfail($a_id);

		$entry = ActivityEntry::findorfail($e_id);

		if($activity->id != $entry->activity_id) {
			return redirect()->back()->with('error', 'Please Try Again Later!');
		}

		// add to activity log
		$action = 'Editor In Chief Downloaded Activity Entry';
        GeneralController::activity_log($action);

		// mark entry as downloaded
		$entry->downloaded = 1;
		$entry->save();

		// download 
		return response()->download(public_path("uploads/entry/{$entry->filename}"));

	}




	// method use to show activity history
	public function activityHistory()
	{
		return view('eic.activity-history');
	}
}
