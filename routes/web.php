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

	// route to go to article review
	Route::get('/article/management', 'AdminController@articleManagement')->name('admin.article.management');

	// route to show audit trail/activity log in admin
	Route::get('/activity/logs', 'AdminController@activityLog')->name('admin.activity.log');
});


Route::group(['prefix' => 'eic', 'middleware' => ['eic','prevent-back-history']], function () {

	Route::get('/dashboard', 'EicController@dashboard')->name('eic.dashboard');
});


Route::group(['prefix' => 'layout/editor', 'middleware' => ['layout.editor','prevent-back-history']], function () {

});


Route::group(['prefix' => 'section/editor', 'middleware' => ['section.editor','prevent-back-history']], function () {

});


Route::group(['prefix' => 'correspondent', 'middleware' => ['correspondent','prevent-back-history']], function () {

});