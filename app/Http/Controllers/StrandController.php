<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Screening;
use App\Models\Strand;
use App\Models\Film;

class StrandController extends Controller
{
  public function single($slug) {
    $collection = Strand::where('slug', $slug)->with('films.screenings')->first();
    // $films = Film::where('season',$collection->id)->with('screenings')->get();
    // ->with(['screenings' => function ($query) {
    //   $query->where('date', '>=', date('Y/m/d'))->with('tags')->orderBy('date')->orderBy('time');
    // }])
    $films = Film::whereHas('strands', function($query) use($collection) {
      $query->where('strand_id', $collection->id);
    })->with(['screenings' => function ($query) {
      $query->where('date', '>=', date('Y/m/d'))->with('tags')->orderBy('date')->orderBy('time');
    }])->get();

    $screenings = new Collection; // Illuminate\Database\Eloquent\Collection

    foreach ($films as $film) {
      $screenings = $screenings->merge($film->screenings);
    }

    $screenings = $screenings->sortBy('time')->sortBy('date');
    // $children = $children->unique(); // remove the duplicates

    if($collection) {
      return view('film.collection', compact('collection','screenings'));
    }
    else {
      abort(404);
    }
  }
}
