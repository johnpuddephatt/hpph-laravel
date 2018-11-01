<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Screening;
use App\Models\Strand;

class StrandController extends Controller
{
  public function single($slug) {
    $collection = Strand::where('slug', $slug)->with('films.screenings')->first();

    $screenings = new Collection; // Illuminate\Database\Eloquent\Collection

    foreach ($collection->films as $film) {
      $screenings = $screenings->merge($film->screenings);
    }

    // $children = $children->unique(); // remove the duplicates

    if($collection) {
      return view('film.collection', compact('collection','screenings'));
    }
    else {
      abort(404);
    }
  }
}
