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

Route::get('/spektrix', 'Controller@spektrix'); // Used by Spektrix for iframe resizing

Route::redirect('16-25', 'membership/16-25', 301);

Route::get('/', 'HomeController@index');
Route::get('day-{day}', 'HomeController@index');

Route::get('picks', 'PickController@index');

Route::redirect('/support', '/donate', 301);

Route::get('winter-fundraiser', function() {
  return view('fundraising');
});

Route::get('staff-seats', function() {
  return view('staff-fundraising');
});

Route::get('film/{slug}', 'FilmController@single');

Route::redirect('whats-on', '/whats-on/weekly', 301);
Route::get('whats-on/a-z', 'FilmController@index');

Route::get('whats-on/weekly', 'ScreeningController@weekly')->name('screenings.weekly');
Route::get('whats-on/weekly/week-{week}', 'ScreeningController@weekly');

Route::get('whats-on/{venue}', 'FilmController@index');

Route::redirect('subscribe', 'http://hydeparkpicturehouse.us4.list-manage.com/subscribe?u=8bc4f3836ccb9012c150eda87&id=9c4ddb7eb6', 301);
Route::redirect('strand/digital-releases', '/strand/watch-online', 301);

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
  CRUD::resource('film', 'FilmCrudController');
  CRUD::resource('slide', 'SlideCrudController');
  CRUD::resource('pick', 'PickCrudController');
  CRUD::resource('screening', 'ScreeningCrudController');
  Route::post ( 'screening/add', '\App\Http\Controllers\ScreeningController@addScreening' );
  Route::post ( 'screening/delete', '\App\Http\Controllers\ScreeningController@deleteScreening' );
  CRUD::resource('strand', 'StrandCrudController');
  CRUD::resource('season', 'SeasonCrudController');
  CRUD::resource('tag', 'TagCrudController');
  CRUD::resource('menu', 'MenuCrudController');
  CRUD::resource('venue', 'VenueCrudController');


  Route::post ( 'slide/{slide}/{state}', '\App\Http\Controllers\SlideController@toggleActive' );
});

Route::get('{collection_type}/{slug}/{order?}', 'CollectionController@single')->where('collection_type', 'strand|season|tag');

Route::get('/imager/{config}/{image}', 'ImageController@default')->where('image', '[A-Za-z0-9\/\.\-\_]+');;

Route::get('{page}/{childpage?}', 'PageController@index');


