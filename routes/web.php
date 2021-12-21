<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Maincontroller@index')->name('main');
Route::post('division', 'Maincontroller@showWeight');
Route::post('ranking', 'Maincontroller@showRanking');
Auth::routes();

Route::get('/home', 'Homecontroller@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('home/league', 'Leaguecontroller@index')->name('league');
	Route::post('home/league/create', 'Leaguecontroller@create')->name('league.create');
	Route::post('home/league/{id}/edit', 'Leaguecontroller@edit')->name('league.edit');
	Route::get('home/league/{id}/destroy', 'Leaguecontroller@destroy');

	Route::get('home/category', 'Categorycontroller@index')->name('category');
	Route::post('home/category/{id}/edit', 'Categorycontroller@edit')->name('category.edit');
	Route::get('home/category/{id}/destroy', 'Categorycontroller@destroy');
	Route::post('home/category/create', 'Categorycontroller@create')->name('category.create');
	Route::post('home/division/create', 'Categorycontroller@createDv')->name('division.create');
	Route::post('home/division/{id}/edit', 'Categorycontroller@editDv');
	Route::get('home/division/{id}/destroy', 'Categorycontroller@destroyDv');
	Route::get('home/division', 'Categorycontroller@index')->name('division');

	Route::get('home/competitors', 'Competitorscontroller@index')->name('competitors');
	Route::post('home/competitors/create', 'Competitorscontroller@create')->name('competitors.create');
	Route::post('home/competitors/{id}/edit', "Competitorscontroller@update")->name('competitors.edit');
	Route::get('home/competitors/{id}/destroy', "Competitorscontroller@destroy");

	Route::get('home/events/event', "Eventscontroller@index")->name("event");
	Route::post('home/events/event/create', "Eventscontroller@create")->name("event.create");
	Route::post('home/events/event/{id}/update', "Eventscontroller@update");
	Route::get('home/events/event/{id}/destroy', "Eventscontroller@destroy");

	Route::get('home/events/event_out', "Eventscontroller@index_out")->name("event_out");

	Route::get('home/points', "Pointscontroller@index")->name('points');
	Route::get('home/points/edit', "Pointscontroller@index_edit")->name('points.edit');
	Route::post('home/points/search', "Pointscontroller@search")->name('points.search');
	Route::get('home/points/{id}/destroy', "Pointscontroller@destroy")->name('points.destroy');
	Route::post('home/points/insert', 'Pointscontroller@insert')->name('points.insert');
	Route::post('home/points/update', 'Pointscontroller@update')->name('points.update');
	Route::get('home/points/{id}/get', 'Pointscontroller@get');

	Route::get("home/change", "Changecontroller@index")->name('change');
	Route::post('home/change/event/search', 'Changecontroller@search');
	Route::post('home/change/event/update', 'Changecontroller@update');
	Route::post('home/change/event/create', 'Changecontroller@create');
	Route::post('home/change/league/search', 'Changecontroller@searchLeague');
	Route::post('home/change/league/change', 'Changecontroller@change');
	Route::post('home/change/league/create', 'Changecontroller@createLeague');
	Route::post('home/change/league/showList', 'Changecontroller@showList');
	Route::post('home/change/weight/search', 'Changecontroller@searchWeight');
	Route::post('home/change/weight/create', 'Changecontroller@createWeight');
	Route::post('home/change/weight/showList', 'Changecontroller@showWeight');
	Route::post('home/change/category/search', 'Changecontroller@searchCategory');
	Route::post('home/change/category/create', 'Changecontroller@createCategory');
	Route::post('home/change/category/showList', 'Changecontroller@showCategory');

});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'Usercontroller', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'Profilecontroller@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'Profilecontroller@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'Profilecontroller@password']);
});

