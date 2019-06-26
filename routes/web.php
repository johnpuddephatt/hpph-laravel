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

Route::get('/', 'HomeController@index');
Route::get('day-{day}', 'HomeController@index');

Route::get('film/{slug}', 'FilmController@single');

Route::redirect('whats-on', '/whats-on/weekly', 301);
Route::get('whats-on/a-z', 'FilmController@index');

Route::get('whats-on/weekly', 'ScreeningController@weekly');
Route::get('whats-on/weekly/week-{week}', 'ScreeningController@weekly');

Route::redirect('subscribe', 'http://hydeparkpicturehouse.us4.list-manage.com/subscribe?u=8bc4f3836ccb9012c150eda87&id=9c4ddb7eb6', 301);


Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
  CRUD::resource('film', 'FilmCrudController');
  CRUD::resource('slide', 'SlideCrudController');
  CRUD::resource('screening', 'ScreeningCrudController');
  Route::post ( 'screening/add', '\App\Http\Controllers\ScreeningController@addScreening' );
  Route::post ( 'screening/delete', '\App\Http\Controllers\ScreeningController@deleteScreening' );
  CRUD::resource('strand', 'StrandCrudController');
  CRUD::resource('season', 'SeasonCrudController');
  CRUD::resource('tag', 'TagCrudController');
  CRUD::resource('menu', 'MenuCrudController');

  Route::post ( 'slide/{id}/{state}', '\App\Http\Controllers\SlideController@toggleActive' );

});

// Route::post ( '/admin/addScreening', 'ScreeningController@addScreening' );
Route::get('strand/{slug}', 'StrandController@single');
Route::get('season/{slug}', 'SeasonController@single');
Route::get('tag/{slug}', 'TagController@single');

// Route::redirect('byob', 'tag/BYOB');
// Route::redirect('ad', 'tag/AD');
// Route::redirect('tw', 'strand/tuesday-wonder');
// Route::redirect('cotn', 'strand/COTN');
// Route::redirect('philosophy', 'strand/philosophy');

Route::get('/imager/{config}/{image}', 'ImageController@default')->where('image', '[A-Za-z0-9\/\.\-\_]+');;

Route::get('{page}/{childpage?}', 'PageController@index');