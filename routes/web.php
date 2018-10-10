<?php

Route::get('/', 'GeneralController@landing')->name('landing');


Route::get('/login', 'GeneralController@login')->name('login');


Route::post('/login', 'LoginController@postLogin')->name('login.post');


Route::get('/logout', 'GeneralController@logout')->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => ['admin','prevent-back-history']], function () {

	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	// route to go to section management
	Route::get('/section/management', 'AdminController@sectionManagement')->name('admin.section.management');

	// route to add section
	Route::get('/section/add', 'AdminController@addSection')->name('admin.add.section');

	// route to save new section
	Route::post('/section/add', 'AdminController@postAddSection')->name('admin.add.section.post');

	// route to update section
	Route::get('/section/{id}/update', 'AdminController@updateSection')->name('admin.update.section');

	// route to save update on section
	Route::post('/section/update', 'AdminController@postUpdateSection')->name('admin.update.section.post');

	Route::get('/section/update', function () {
		return redirect()->route('admin.section.management');
	});

	// route to remove section
	Route::post('/section/remove', 'AdminController@postRemoveSection')->name('admin.remove.section.post');

	Route::get('/section/remove', function () {
		return redirect()->route('admin.section.management');
	});

	// route to go to article review
	Route::get('/article/management', 'AdminController@articleManagement')->name('admin.article.management');

	// route to go to publish management
	Route::get('/publish', 'AdminController@publish')->name('admin.publish');

	// route to show audit trail/activity log in admin
	Route::get('/activity/logs', 'AdminController@activityLog')->name('admin.activity.log');
});


Route::group(['prefix' => 'eic', 'middleware' => ['eic','prevent-back-history']], function () {

	Route::get('/dashboard', 'EicController@dashboard')->name('eic.dashboard');

	// route to go to layout editor management
	Route::get('/layout-editor/management', 'EicController@layoutEditorManagement')->name('eic.layout.editor.management');

	// route to add layout editor
	Route::get('/layout-editor/management/add', 'EicController@addLayoutEditor')->name('eic.add.layout.editor');

	// route to save new layout editor
	Route::post('/layout-editor/management/add', 'EicController@postAddLayoutEditor')->name('eic.add.layout.editor.post');

	// route to update layout editor
	Route::get('/layout-editor/management/{id}/update', 'EicController@updateLayoutEditor')->name('eic.update.layout.editor');

	// route to save update layout editor
	Route::post('/layout-editor/management/update', 'EicController@postUpdateLayoutEditor')->name('eic.update.layout.editor.post');

	Route::get('/layout-editor/management/update', function () {
		return redirect()->route('eic.layout.editor.management');
	});

	// route to remove layout editor 
	Route::post('/layout-editor/management/remove', 'EicController@postRemoveLayoutEditor')->name('eic.remove.layout.editor.post');

	Route::get('/layout-editor/management/remove', function () {
		return redirect()->route('eic.layout.editor.management');
	});

	// route to go to section editor management
	Route::get('/section-editor/management', 'EicController@sectionEditorManagement')->name('eic.section.editor.management');

	// route to add section editor 
	Route::get('/section-editor/management/add', 'EicController@addSectionEditor')->name('eic.add.section.editor');

	// route to save new section editor
	Route::post('/section-editor/management/add', 'EicController@postAddSectionEditor')->name('eic.add.section.editor.post');

	// route to update section editor
	Route::get('/section-editor/management/{id}/update', 'EicController@updateSectionEditor')->name('eic.update.section.editor');

	// route to save update on section editor
	Route::post('/section-editor/management/update', 'EicController@postUpdateSectionEditor')->name('eic.update.section.editor.post');

	Route::get('/section-editor/management/update', function () {
		return redirect()->route('eic.layout.editor.management');
	});

	// route to remove section editor
	Route::post('/section-editor/management/remove', 'EicController@postRemoveSectionEditor')->name('eic.remove.section.editor.post');

	// route to go to correspondent management
	Route::get('/correspondent/management', 'EicController@correspondentManagement')->name('eic.correspondent.management');

	// route to add correspondents
	Route::get('/correspondent/management/add', 'EicController@addCorrespondent')->name('eic.add.correspondent');

	// route to save new correspondents
	Route::post('/correspondent/management/add', 'EicController@postAddCorrespondent')->name('eic.add.correspondent.post');

	// route to update correspondent
	Route::get('/correspondent/management/{id}/update', 'EicController@updateCorrespodent')->name('eic.update.correspondent');

	// route to save update on correspondent
	Route::post('/correspondent/management/update', 'EicController@postUpdateCorrespodent')->name('eic.update.correspondent.post');

	Route::get('/correspondent/management/update', function () {
		return redirect()->route('eic.correspondent.management');
	});

	// route to remove correspondent
	Route::post('/correspondent/management/remove', 'EicController@postRemoveCorrespondent')->name('eic.remove.correspondent.post');

	// route to go to article management
	Route::get('/article/management', 'EicController@articleManagement')->name('eic.article.management');

	// route to view approved articles
	Route::get('/articles/approved', 'EicController@approvedArticles')->name('eic.approved.articles');

	// route to view article
	Route::get('/article/{id}/view', 'EicController@viewArticle')->name('eic.view.article');


	// route to save update in article
	Route::post('/article/approve', 'EicController@postApproveArticle')->name('eic.approve.article');

	Route::get('/article/approve', function () {
		return redirect()->route('eic.article.management');
	});

	// route to go to layout management
	Route::get('/layout/management', 'EicController@layoutManagement')->name('eic.layout.management');
});


Route::group(['prefix' => 'layout/editor', 'middleware' => ['layout.editor','prevent-back-history']], function () {

	Route::get('/dashboard', 'LayoutEditorController@dashboard')->name('le.dashboard');

});


Route::group(['prefix' => 'section/editor', 'middleware' => ['section.editor','prevent-back-history']], function () {

	Route::get('/dashboard', 'SectionEditorController@dashboard')->name('se.dashboard');

	// route to view articles based on what artciles assigned to the section editor
	Route::get('/articles', 'SectionEditorController@articles')->name('se.articles');

	// rotue to view proofreaded articles by se
	Route::get('/articles/approved', 'SectionEditorController@approvedArticles')->name('se.approved.articles');

	// route to view/edit articles --- open article
	Route::get('/article/{id}/view/edit', 'SectionEditorController@viewArticle')->name('se.view.edit.article');

	// route to clsoe viewing article
	Route::get('/article/{id}/close', 'SectionEditorController@closeViewArticle')->name('se.close.viewing.article');

	// route to approve article by section editor
	Route::post('/article/approve', 'SectionEditorController@postApproveArticle')->name('se.approve.article.post');

	Route::get('/article/approve', function () {
		return redirect()->route('se.approved.articles');
	});

	// route to deny article by section editor
	Route::post('/article/deny', 'SectionEditorController@postDenyArticle')->name('se.deny.article.post');

	// route to view only article
	Route::get('/article/{id}/view', 'SectionEditorController@viewOnlyArticle')->name('se.view.only.article');

	// route to download article
	Route::get('/article/{id}/download', 'SectionEditorController@downloadArticle')->name('se.download.article');

});


Route::group(['prefix' => 'correspondent', 'middleware' => ['correspondent','prevent-back-history']], function () {

	Route::get('/dashboard', 'CorrespondentController@dashboard')->name('correspondent.dashboard');

	// route to view articles
	Route::get('/articles', 'CorrespondentController@articles')->name('correspondent.articles');

	// route to add article
	Route::get('/article/new', 'CorrespondentController@newArticle')->name('correspondent.new.article');

	// route to add new article
	Route::post('/article/new', 'CorrespondentController@postNewArticle')->name('correspondent.new.article.post');

	// route to view articles
	Route::get('/article/{id}/view', 'CorrespondentController@viewArticle')->name('correspondent.view.article');

	// route to edit denied article
	Route::get('/article/{id}/deny/edit', 'CorrespondentController@editDenyArticle')->name('correspondent.edit.deny.article');

	// route to save update on denied article
	Route::post('/article/update', 'CorrespondentController@postUpdateArticle')->name('correspondent.update.article.post');
});