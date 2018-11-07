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
    // URL => film column name
    $pseudoTagArray = ['AD' => 'audio_description'];

    if(array_key_exists($slug,$pseudoTagArray)) {
      $film_ids = Film::where($pseudoTagArray[$slug],true)->pluck('id');
      $screenings = Screening::whereIn('film_id',$film_ids)->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->get();
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
