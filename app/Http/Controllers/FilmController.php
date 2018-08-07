<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Screening;
use Carbon\Carbon;

class FilmController extends Controller
{
  public function single($slug) {

    $film = Film::where('slug',$slug)->with(['screenings' => function ($query) {
      $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time');
    }])->first();

    if(!$film) abort(404);
    return view('film.single', compact('film'));
  }

  public function index() {

    // $films = Film::whereHas('screenings', function ($query) {
      // $query->where('date', '>=', date('Y/m/d'));
    // })->with(['screenings' => function ($query) {
      // $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time');
    // }])->orderBy('title')->get();

    // $films = Film::hasFutureScreenings()->with(['screenings' => function ($query) {
    // $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time');
    // }])->orderBy('title')->get();
    $array = '';
    $films = Film::hasFutureScreenings()->with(['screenings' => function ($query) {
      $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time');
    }])->get()->sortBy(function ($i) {

      return trim(str_replace('The', '', ' ' . $i['title'] . ' '));
    });


    // foreach($films as $film) {
    //   $film->start_date = Carbon::parse($film->screenings->first()->date)->format('d F');
    //   $film->start_date_day = explode(' ', $film->start_date)[0];
    //   $film->start_date_month = last(explode(' ', $film->start_date));
    //   $film->end_date = Carbon::parse($film->screenings->last()->date)->format('d F');
    //   $film->end_date_month = last(explode(' ', $film->end_date));
    // }

    return view('film.a-z', compact('films'));
  }
}
