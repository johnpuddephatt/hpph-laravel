<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Screening;

class FilmController extends Controller
{
  public function single($slug) {
    $film = Film::where('slug', $slug)->with('screenings')->first();
    return view('film.single', compact('film'));
  }
}
