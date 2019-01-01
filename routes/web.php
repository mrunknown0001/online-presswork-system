<?php

Route::get('/publication/{id}', 'CorrespondentController@subjectsInPublication');

Route::get('/', 'GeneralController@landing')->name('landing');


Route::get('/login', 'GeneralController@login')->name('login');


Route::post('/login', 'LoginController@postLogin')->name('login.post');


Route::get('/logout', 'GeneralController@logout')->name('logout');


Route::get('/about-us', 'GeneralController@aboutUs')->name('about.us');

Route::get('/contact-us', 'GeneralController@contactUs')->name('contact.us');

// route to submit layout of student
Route::get('/activity/{id}/submit/entry', 'GeneralController@submitEntry')->name('submit.entry');

// route to save submitted entry
Route::post('/activity/submit/entry', 'GeneralController@postSubmitEntry')->name('submit.entry.post');


Route::group(['prefix' => 'admin', 'middleware' => ['admin','prevent-back-history']], function () {


	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	// route to change password
	Route::get('/password/change', 'AdminController@changePassword')->name('admin.change.password');

	// route to save new password
	Route::post('/password/change', 'AdminController@postChangePassword')->name('admin.change.password.post');


	// route to go to article review
	Route::get('/article/management', 'AdminController@articleManagement')->name('admin.article.management');

	// route to view article and maybe proofread by admin
	Route::get('/article/{id}/view/edit', 'AdminController@viewEditArticle')->name('admin.view.edit.article');

	// route to approve article
	Route::post('/article/approve', 'AdminController@postApproveArticle')->name('admin.approve.article.post');

	// route to view approved article
	Route::get('/article/approved/view', 'AdminController@viewApprovedArticle')->name('admin.view.approved.article');

	// route to view denied articles
	Route::get('/article/denied/view', 'AdminController@viewDeniedArticle')->name('admin.view.denied.article');

	// route to go to publish management
	Route::get('/publish', 'AdminController@publish')->name('admin.publish');

	// route to approve layout in publish
	Route::get('/publish/layout/{id}/approve', 'AdminController@approveLayoutPublish')->name('admin.approve.layout.publish');

	// route to view approved layout to publish
	Route::get('/publish/layout/approved', 'AdminController@approvedLayoutPublish')->name('admin.approved.layout.publish');

	// route to deny layout to publish
	Route::get('/publish/layout/{id}/deny', 'AdminController@denyLayoutPublish')->name('admin.deny.layout.publish');

	// route to view denied layout
	Route::get('/publish/denied/layout', 'AdminController@deniedLayoutPublish')->name('admin.denied.layout.publish');

	// route to show audit trail/activity log in admin
	Route::get('/activity/logs', 'AdminController@activityLog')->name('admin.activity.log');

	// route to import and back database
	Route::get('/database/backup', 'AdminController@databaseBackup')->name('admin.backup.database');


	// back up operation in end of the routes


	// route to restore database
	Route::post('/database/restore', 'AdminController@postDatabaseRestore')->name('admin.restore.database.post');

});


Route::group(['prefix' => 'eic', 'middleware' => ['eic','prevent-back-history']], function () {

	Route::get('/dashboard', 'EicController@dashboard')->name('eic.dashboard');

	// route to change password
	Route::get('/password/change', 'EicController@changePassword')->name('eic.change.password');

	// route to save new password
	Route::post('/password/change', 'EicController@postChangePassword')->name('eic.change.password.post');

	// route to reset password of users to password
	Route::get('/users/{id}/password/reset', 'EicController@resetPasswordReset')->name('eic.reset.user.password');

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




	// route to go to section management
	Route::get('/section/management', 'EicController@sectionManagement')->name('eic.section.management');

	// route to add section
	Route::get('/section/add', 'EicController@addSection')->name('eic.add.section');

	// route to save new section
	Route::post('/section/add', 'EicController@postAddSection')->name('eic.add.section.post');

	// route to update section
	Route::get('/section/{id}/update', 'EicController@updateSection')->name('eic.update.section');

	// route to save update on section
	Route::post('/section/update', 'EicController@postUpdateSection')->name('eic.update.section.post');

	Route::get('/section/update', function () {
		return redirect()->route('eic.section.management');
	});

	// route to remove section
	Route::post('/section/remove', 'EicController@postRemoveSection')->name('eic.remove.section.post');

	Route::get('/section/remove', function () {
		return redirect()->route('eic.section.management');
	});







	

	// route to go to article management
	Route::get('/article/management', 'EicController@articleManagement')->name('eic.article.management');

	// route to view approved articles
	Route::get('/articles/approved', 'EicController@approvedArticles')->name('eic.approved.articles');

	// route to view dneied article
	Route::get('/article/denied/view', 'EicController@viewDeniedArticle')->name('eic.view.denied.article');

	// route to view article
	Route::get('/article/{id}/view', 'EicController@viewArticle')->name('eic.view.article');


	// route to save update in article
	Route::post('/article/approve', 'EicController@postApproveArticle')->name('eic.approve.article');

	Route::get('/article/approve', function () {
		return redirect()->route('eic.article.management');
	});

	// route to view update
	Route::get('/article/{id}/view/update', 'EicController@viewUpdateArticle')->name('eic.view.update.article');

	// route to deny articles
	Route::post('/article/deny', 'EicController@postDenyArticle')->name('eic.deny.article.post');

	Route::get('/article/deny', function () {
		return redirect()->route('eic.article.management');
	});

	// route to go to layout management
	Route::get('/layout/management', 'EicController@layoutManagement')->name('eic.layout.management');

	// route to approve layout
	Route::get('/layout/{id}/approve', 'EicController@approveLayout')->name('eic.approve.layout');

	// route to view approved layouts
	Route::get('/layouts/approved', 'EicController@viewApprovedLayouts')->name('eic.view.approved.layouts');

	// route to deny layout
	Route::get('/layout/{id}/deny', 'EicController@denyLayout')->name('eic.deny.layout');

	// route to submit deny
	Route::post('/layout/deny', 'EicController@postDenyLayout')->name('eic.deny.layout.post');

	// route to view denied layout
	Route::get('/layout/denied', 'EicController@deniedLayouts')->name('eic.denied.layouts');




	Route::get('/publications', 'EicController@publications')->name('eic.publications');

	// route to open publication and select
	Route::get('/publication/{id}/open', 'EicController@openPublication')->name('eic.open.publication');

	// route to save selected section on open publication
	Route::post('/publication/open', 'EicController@postOpenPublication')->name('eic.open.publication.post');

	Route::get('/publication/open', function () {
		return redirect()->route('eic.publications');
	});

	// route to close publication
	Route::get('/publication/delete/{id}', 'EicController@closePublication')->name('eic.close.publication');

	// route to manage activities
	Route::get('/activities', 'EicController@activities')->name('eic.activities');

	// route to add new activity
	Route::get('/activity/add', 'EicController@addActivity')->name('eic.add.activity');

	// route to save new activity
	Route::post('/activity/add', 'EicController@postAddActivity')->name('eic.add.activity.post');

	// route to deactivate activity
	Route::post('/activity/deactivate', 'EicController@postDeactivateActivity')->name('eic.deactivate.activity.post');

	// route to update activity

	// route to save update activity

	// route to view entries in activity
	Route::get('/activity/{id}/entries/view', 'EicController@viewActivityEntries')->name('eic.view.activity.entries');

	// route to send email in entry email
	Route::get('/activity/{id}/entry/{eid}/send-mail', 'EicController@sendMailActivityEntry')->name('eic.send.mail.activity.entry');

	// route to save send
	Route::post('/activity/entry/send-email', 'EicController@postSendMailActivityEntry')->name('eic.send.mail.activity.entry.post');

	// route to show activity history
	Route::get('/activity/history', 'EicController@activityHistory')->name('eic.history.activity');

});


Route::group(['prefix' => 'layout/editor', 'middleware' => ['layout.editor','prevent-back-history']], function () {

	Route::get('/dashboard', 'LayoutEditorController@dashboard')->name('le.dashboard');

	// route to change password
	Route::get('/password/change', 'LayoutEditorController@changePassword')->name('le.change.password');

	// route to save new password
	Route::post('/password/change', 'LayoutEditorController@postChangePassword')->name('le.change.password.post');

	// route to layout editor
	Route::get('/layouts/management', 'LayoutEditorController@layoutsManagement')->name('le.layouts.management');


	Route::get('/publication/get/{publicationId}', 'LayoutEditorController@getPublication');

	// route to add layout
	Route::get('/layout/add', 'LayoutEditorController@addLayout')->name('le.add.layout');

	// route to save and add layout
	Route::post('/layout/add', 'LayoutEditorController@postAddLayout')->name('le.add.layout.post');


	// route to view denied layout
	Route::get('/layout/denied', 'LayoutEditorController@deniedLayout')->name('le.denied.layout');

	// route to comply with denied layout
	// reupload revised
	Route::get('/layout/{id}/denied/re-submit', 'LayoutEditorController@resubmitLayout')->name('le.resubmit.layout');

	// route to save resubmit layout
	Route::post('/layout/denied/re-submit', 'LayoutEditorController@postResubmitLayout')->name('le.resubmit.layout.post');


	// route to view approved articles
	Route::get('/artciles', 'LayoutEditorController@articles')->name('le.artciles');

});


Route::group(['prefix' => 'section/editor', 'middleware' => ['section.editor','prevent-back-history']], function () {

	Route::get('/dashboard', 'SectionEditorController@dashboard')->name('se.dashboard');

	// route to change password
	Route::get('/password/change', 'SectionEditorController@changePassword')->name('se.change.password');

	// route to save new password
	Route::post('/password/change', 'SectionEditorController@postChangePassword')->name('se.change.password.post');

	// route to view articles based on what artciles assigned to the section editor
	Route::get('/articles', 'SectionEditorController@articles')->name('se.articles');

	// rotue to view proofreaded articles by se
	Route::get('/articles/approved', 'SectionEditorController@approvedArticles')->name('se.approved.articles');

	// route to view denied
	Route::get('/article/denied/view', 'SectionEditorController@viewDeniedArticle')->name('se.view.denied.article');

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

	// route to update article
	Route::get('/article/{id}/update', 'SectionEditorController@updateArticle')->name('se.update.article');

	// route to save update on aritcle edit
	Route::post('/article/update', 'SectionEditorController@postUpdateArticle')->name('se.update.article.post');

	Route::get('/article/update', function () {
		return redirect()->route('se.view.denied.article');
	});

});


Route::group(['prefix' => 'correspondent', 'middleware' => ['correspondent','prevent-back-history']], function () {

	Route::get('/dashboard', 'CorrespondentController@dashboard')->name('correspondent.dashboard');

	// route to change password
	Route::get('/change/password', 'CorrespondentController@changePassword')->name('correspondent.change.password');

	// route to save new password
	Route::post('/change/password', 'CorrespondentController@postChangePassword')->name('correspondent.change.password.post');

	// route to view articles
	Route::get('/articles', 'CorrespondentController@articles')->name('correspondent.articles');

	// route to add article
	Route::get('/article/new', 'CorrespondentController@newArticle')->name('correspondent.new.article');


	// route to get section under open publication
	Route::get('/publication/{id}', 'CorrespondentController@subjectsInPublication');

	// route to add new article
	Route::post('/article/new', 'CorrespondentController@postNewArticle')->name('correspondent.new.article.post');

	// route to view articles
	Route::get('/article/{id}/view', 'CorrespondentController@viewArticle')->name('correspondent.view.article');

	// route to edit denied article
	Route::get('/article/{id}/deny/edit', 'CorrespondentController@editDenyArticle')->name('correspondent.edit.deny.article');

	// route to save update on denied article
	Route::post('/article/update', 'CorrespondentController@postUpdateArticle')->name('correspondent.update.article.post');


	// route to view article version
	Route::get('/aritcle/{id}/versions', 'CorrespondentController@articleVersions')->name('correspondent.article.versions');
});

///////////////////////////////
// route to download article //
///////////////////////////////
Route::get('/section/editor/article/{id}/download', 'SectionEditorController@downloadArticle')->name('se.download.article');

Route::get('/eic/article/{id}/download', 'EicController@downloadArticle')->name('eic.download.article');

Route::get('/admin/article/{id}/download', 'AdminController@downloadArticle')->name('admin.download.article');

Route::get('/layout/editor/article/{id}/download', 'LayoutEditorController@downloadArticle')->name('le.download.article');



// route to download entry
// route to download entry of an activity
Route::get('/eic/activity/{a_id}/entry/{e_id}/download', 'EicController@downloadActivityEntry')->name('eic.download.activity.entry');


// database backup download
// route to backup database and download applicable only in server
Route::get('/admin/database/backup/download', 'AdminController@downloadDatabaseBackup')->name('admin.download.backup.database');