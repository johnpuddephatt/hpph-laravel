<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Screening;
use Carbon\Carbon;

class FilmController extends Controller
{
  public function single($slug) {
    $film = Film::where('slug', $slug)->first();
    if(!$film) abort(404);
    $screenings = Screening::where([['film_id',$film->id],['date', '>=', date('Y/m/d')]])->orderBy('date')->orderBy('time')->get();
    return view('film.single', compact('film','screenings'));
  }
}
