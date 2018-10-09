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
    						->get();

    	return view('se.articles', ['articles' => $articles]);
    }
}
