<?php

Route::get('/', 'GeneralController@landing')->name('landing');


Route::get('/login', 'GeneralController@login')->name('login');


Route::post('/login', 'LoginController@postLogin')->name('login.post');


Route::get('/logout', 'GeneralController@logout')->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
});


Route::group(['prefix' => 'eic', 'middleware' => 'eic'], function () {

	Route::get('/dashboard', 'EicController@dashboard')->name('eic.dashboard');
});


Route::group(['prefix' => 'layout/editor', 'middleware' => 'layout.editor'], function () {

});


Route::group(['prefix' => 'section/editor', 'middleware' => 'section.editor'], function () {

});


Route::group(['prefix' => 'correspondent', 'middleware' => 'correspondent'], function () {

});