<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;


use App\Models\Film;
use App\Models\Screening;
use App\Models\Tag;

class TagController extends Controller
{
  public function single($slug) {

    $collection = Tag::where('slug', $slug)->first();
    // Pseudo-tags: e.g. Audio description
    $pseudoTagArray = ['audio-description'];

    if(in_array($slug,$pseudoTagArray)) {
      $films = Film::where(str_replace('-', '_', $slug),true)->with(['screenings' => function ($query) {
        $query->where('date', '>=', date('Y/m/d'))->with('tags')->orderBy('date')->orderBy('time');
      }])->get();
      $screenings = new Collection; // Illuminate\Database\Eloquent\Collection
      foreach ($films as $film) {
        $screenings = $screenings->merge($film->screenings);
      }
      return view('film.collection', compact('collection','screenings'));
    }
    elseif($collection) {
        $screenings = $collection->screenings()->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->get();
        $screenings = $screenings;
        return view('film.collection', compact('collection','screenings'));
    }
    else {
      abort(404);
    }
  }
}
