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
use App\Models\Strand;
use App\Models\Season;

class CollectionController extends Controller
{
  public function single($collection_type, $slug, $order = 'screening') {

    if($collection_type == 'tag') {
      $collection = Tag::where('slug', $slug)->with('screenings')->first();
      $pseudoTagArray = ['AD' => 'audio_description'];

      if(array_key_exists($slug,$pseudoTagArray)) {
        $film_ids = Film::where($pseudoTagArray[$slug],true)->pluck('id');
        $screenings = Screening::whereIn('film_id',$film_ids)->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->get();
      }
      else {
        $screenings = $collection->screenings()->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->get();
        $film_ids = array_unique($screenings->pluck('film_id')->toArray());
      }

      if($collection->order == 'film') {
        $films = Film::whereIn('id',$film_ids)->hasFutureScreenings()->with(['screenings','strands'])->orderBy('title')->get();
      }

    }

    if($collection_type == 'strand' || $collection_type == 'season') {
      if($collection_type == 'strand') {
        $collection = Strand::where('slug', $slug)->with('films.screenings')->firstOrFail();
      }
      elseif($collection_type == 'season') {
        $collection = Season::where('slug', $slug)->with('films.screenings')->firstOrFail();
      }

      if($collection->order == 'film') {
        $films = $collection->films()->hasFutureScreenings()->with(['screenings','strands'])->orderBy('title')->get();
      }
      else {
        $film_ids = $collection->films()->pluck('film_id');
        $screenings = Screening::whereIn('film_id',$film_ids)->where('date', '>=', date('Y/m/d'))->with(['film.strands','tags'])->orderBy('date')->orderBy('time')->get();
      }
    }

    // Pass the right things to the view depending on whether we're after film or screening view

    if($collection->order == 'film') {
      return view('film.collection', compact('collection','films'));
    }

    else {
      return view('film.collection', compact('collection','screenings'));
    }

  }
}
