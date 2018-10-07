<?php

Route::get('/', function () {
    return view('landing');
})->name('landing');


Route::get('/login', function () {
	return view('login');
})->name('login');


Route::post('/login', 'LoginController@postLogin')->name('login.post');


Route::get('/logout', 'GeneralController@logout')->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

	Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
});


Route::group(['prefix' => 'eic', 'middleware' => 'eic'], function () {

});


Route::group(['prefix' => 'layout/editor', 'middleware' => 'layout.editor'], function () {

});


Route::group(['prefix' => 'section/editor', 'middleware' => 'section.editor'], function () {

});


Route::group(['prefix' => 'correspondent', 'middleware' => 'correspondent'], function () {

});