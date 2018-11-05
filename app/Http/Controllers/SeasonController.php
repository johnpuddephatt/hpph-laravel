<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Screening;
use App\Models\Season;
use App\Models\Film;

class SeasonController extends Controller
{
  public function single($slug) {
    $collection = Season::where('slug', $slug)->with('films.screenings')->first();

    $films = Film::whereHas('seasons', function($query) use($collection) {
      $query->where('season_id', $collection->id);
    })->with(['screenings' => function ($query) {
      $query->where('date', '>=', date('Y/m/d'))->with('tags')->orderBy('date')->orderBy('time');
    }])->get();

    $screenings = new Collection; // Illuminate\Database\Eloquent\Collection
    foreach ($films as $film) {
      $screenings = $screenings->merge($film->screenings);
    }
    // $children = $children->unique(); // remove the duplicates
    $screenings = $screenings->sortBy('time')->sortBy('date');
    if($collection) {
      return view('film.collection', compact('collection','screenings'));
    }
    else {
      abort(404);
    }
  }
}
