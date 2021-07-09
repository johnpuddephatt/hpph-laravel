<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Film;
use App\Models\Venue;
use App\Models\Screening;
use Carbon\Carbon;

class FilmController extends Controller
{
  public function single($slug) {

    $film = Film::where('slug',$slug)
                ->withCount('screenings')
                ->with(['screenings' => function ($query) {
                  $query->where('date', '>=', date('Y/m/d'))
                        ->with('tags')
                        ->orderBy('date')
                        ->orderBy('time');
                }])
                ->with(['strands', 'seasons', 'venue'])
                ->firstOrFail();

    return view('film.single', compact('film'));
  }

  public function index(Venue $venue = null) {

    $films = Film::hasFutureScreenings()
              ->atVenue($venue)
              ->with(['screenings' => function ($query) {
                $query->where('date', '>=', date('Y/m/d'))
                      ->orderBy('date')
                      ->orderBy('time')
                      ->with('tags');
              }])
              ->with(['strands', 'seasons', 'venue'])
              ->get()
              ->sortBy(function ($film) {
                return trim(str_replace('The', '', ' ' . $film['title'] . ' '));
              });

    return view('listings.a-z', compact('films','venue'));
  }
}
