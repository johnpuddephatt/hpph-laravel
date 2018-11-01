<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Screening;
use Carbon\Carbon;

class FilmController extends Controller
{
  public function single($slug) {

    $film = Film::where('slug',$slug)->withCount('screenings')->with(['screenings' => function ($query) {
      $query->where('date', '>=', date('Y/m/d'))->with('tags')->orderBy('date')->orderBy('time');
    }])->with('strands')->with('seasons')->first();

    if(!$film) abort(404);
    return view('film.single', compact('film'));
  }

  public function index() {

    $films = Film::hasFutureScreenings()->with(['screenings' => function ($query) {
      $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->with('tags');
    }])->with('strands')->with('seasons')->get()->sortBy(function ($i) {
      return trim(str_replace('The', '', ' ' . $i['title'] . ' '));
    });

    return view('listings.a-z', compact('films'));
  }
}
