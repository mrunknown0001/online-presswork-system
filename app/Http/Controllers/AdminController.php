<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Controllers\GeneralController;

use App\ActivityLog;
use App\Section;
use App\Article;
use App\Layout;

class AdminController extends Controller
{
    // method use to go to admin dashboard
    public function dashboard()
    {
        $approved_layouts = Layout::where('eic_approved', 1)->count();
        $activity_logs = ActivityLog::count();

    	return view('admin.dashboard', ['approved_layouts' => $approved_layouts, 'activity_logs' => $activity_logs]);
    }


    // method use to change password form
    public function changePassword()
    {
        return view('admin.password-change');
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
            $action = 'Admin Changed Password';
            GeneralController::activity_log($action);

            // return to dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Password Changed!');
        }

        return redirect()->back()->with('error', 'Incorrect Password!');
    }


    // method use to show articles management
    public function articleManagement()
    {
        $articles = Article::where('eic_proofread', 1)
                        ->where('admin_proofread', 0)
                        ->where('admin_deny', 0)
                        ->orderBy('created_at', 'asc')
                        ->paginate(15);

        return view('admin.article', ['articles' => $articles]);
    }


    // method to view/edit article
    public function viewEditArticle($id)
    {
        $article = Article::findorfail($id);

        if($article->eic_proofread != 1 || $article->admin_deny != 0) {
            return redirect()->back()->with('error', 'Please Reload This Page and Try Again!');
        }

        // return with image
        return view('admin.article-view-edit', ['article' => $article]);
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

        $article = Article::findorfail($id);

        // approve
        $article->admin_proofread = 1;
        $article->admin_proofread_date = now();
        $article->save();

        $action = 'Admin Approved Article ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return redirect()->route('admin.article.management')->with('success', 'Article Approved!');
    }


    // method use to view approved articles
    public function viewApprovedArticle()
    {
        $articles = Article::where('eic_proofread', 1)
                        ->where('admin_proofread', 1)
                        ->where('admin_deny', 0)
                        ->orderBy('admin_proofread_date', 'desc')
                        ->paginate(15);

        return view('admin.article-approved', ['articles' => $articles]);
    }


    // method use to view denied articles
    public function viewDeniedArticle()
    {
        $articles = Article::where('eic_proofread', 1)
                        ->where('admin_deny', 1)
                        ->orderBy('eic_proofread_date', 'desc')
                        ->paginate(15);

        return view('admin.article-denied', ['articles' => $articles]);
    }


    // method use to download
    public function downloadArticle($id = null)
    {
        $article = Article::findorfail($id);

        $filename = $article->title . '.html';

        Storage::put($filename, $article->content);

        $action = 'Admin Downloaded Article ' . ucwords($article->title);
        GeneralController::activity_log($action);

        return response()->download(storage_path("app/{$filename}"));
    }


    // method use to publish and deny articles 
    public function publish()
    {
        // get all layouts approved by eic
        $layouts = Layout::where('active', 1)
                    ->where('eic_approved', 1)
                    ->where('admin_approved', 0)
                    ->where('admin_deny', 0)
                    ->paginate(5);


        return view('admin.publish', ['layouts' => $layouts]);
    }


    // method use to approve layout publish
    public function approveLayoutPublish($id = null)
    {
        $layout = Layout::findorfail($id);

        // check if layout is approved by eic

        // mark layout as approved by admin
        $layout->admin_approved = 1;
        $layout->admin_approved_date = now();
        $layout->save();

        // add to activity log
        $action = 'Admin Aproved Layout to Publish ' . ucwords($layout->title);
        GeneralController::activity_log($action);

        // return to publish
        return redirect()->route('admin.publish')->with('success', 'Layout Approved to Publish!');

    }


    // method use to view approved layout to publish
    public function approvedLayoutPublish()
    {
        $layouts = Layout::where('admin_approved', 1)
                        ->orderBy('admin_approved_date', 'desc')
                        ->paginate(5);

        return view('admin.publish-approved', ['layouts' => $layouts]);

    }


    // method use to deny layout
    public function denyLayoutPublish($id = null)
    {
        $layout = Layout::findorfail($id);

        // mark as denied 
        $layout->admin_deny = 1;
        $layout->admin_deny_date = now();
        $layout->save();

        // add to activity log
        $action = 'Admin Denied Layout to Publish ' . ucwords($layout->title);
        GeneralController::activity_log($action);

        // return to publish
        return redirect()->route('admin.publish')->with('success', 'Layout Denied!');

    }


    // method use to view denied layout 
    public function deniedLayoutPublish()
    {
        $layouts = Layout::where('admin_deny', 1)
                        ->orderBy('admin_deny_date', 'desc')
                        ->paginate(5);

        return view('admin.publish-denied', ['layouts' => $layouts]);
    }


    // method use to show activity log
    // audit trail
    public function activityLog()
    {
    	$logs = ActivityLog::orderBy('created_at', 'desc')
    				->paginate(15);

    	return view('admin.activity-log', ['logs' => $logs]);
    }


    // method use to backup and restore database
    public function databaseBackup()
    {
        return view('admin.database');
    }


    // method use to backup database
    public function downloadDatabaseBackup()
    {
        // run command to backup whole database
        exec('mysqldump -u root -pOpenroot presswork > /var/www/laravel/public/uploads/database/presswork.sql');

        $action = 'Admin perform backup database';
        GeneralController::activity_log($action);

        // download database
        return response()->download('/var/www/laravel/public/uploads/database/presswork.sql');

    }


    // method use to restore database
    public function postDatabaseRestore(Request $request)
    {
        $request->validate([
            'database' => 'required'
        ]);

        if(pathinfo($request->database->getClientOriginalName(), PATHINFO_EXTENSION)!=='sql'){
            return redirect()->back()->with('error', 'Invalid File!');
        }

        // upload sql file
        $filename = 'presswork' . '.' . $request->database->getClientOriginalExtension();

        $request->database->move(public_path('uploads/database'), $filename);

        // mysqladmin -u root -pOpenroot drop presswork
        exec('mysqladmin -u root -pOpenroot drop presswork');

        // msyqladmin -u root -pOpenroot create presswork
        exec('mysqladmin -u root -pOpenroot create presswork');

        // mysql -u root -pOpenroot presswork < /[directory]
        exec('mysql -u root -pOpenroot presswork < /var/www/laravel/public/uploads/database/presswork.sql');

        $action = 'Admin perform restored database';
        GeneralController::activity_log($action);

        // return 
        return redirect()->back()->with('success', 'Database Restored!');
    }
}
