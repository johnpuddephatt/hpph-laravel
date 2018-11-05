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
    $collection = Season::where('slug', $slug)->first();

    $film_ids = Film::whereHas('seasons', function($query) use($collection) {
      $query->where('season_id', $collection->id);
    })->pluck('id');

    $screenings = Screening::whereIn('film_id',$film_ids)->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->get();

    if($collection) {
      return view('film.collection', compact('collection','screenings'));
    }
    else {
      abort(404);
    }
  }
}
