<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Http\Requests\ScreeningRequest;
use App\Models\Screening;
use App\Models\Tag;

class ScreeningController extends Controller
{
  // public function future() {
  //   $screenings = Screening::where('date', '>=', date('Y/m/d'))->with('tags')->orderBy('date')->orderBy('time')->get();
  //   return view('home', compact('screenings'));
  // }

  public function weekly($week = 1) {

    $tag_filter = Input::get('tag_filter');

    // Check week value is in range
    if($week < 1 || $week > 8) abort(404);

    // First week; collect today screenings separately
    if($week == 1) {
      $week_commencing = date("Y/m/d",$this->today + DAYINSECONDS);
      $screenings_today_query = Screening::laterToday()
                          ->with(['film.strands','film.venue','tags'])
                          ->orderBy('date')
                          ->orderBy('time');
    }
    // Other weeks
    else {
      $week_commencing = date("Y/m/d",time() + (($week - 1) * 7) * DAYINSECONDS);
    }

    // For all weeks
    $week_ending = date("Y/m/d",time() + ((($week - 1) * 7) + 6) * DAYINSECONDS);
    $screenings_query = Screening::whereBetween('date',[$week_commencing,$week_ending])
                                  ->with(['film.strands','film.venue','tags'])
                                  ->orderBy('date')
                                  ->orderBy('time');

    // Apply the filter(s)
    // if($tag_filter) {
    //   if($week == 1) {
    //     $screenings_today_query = $screenings_today_query->whereHas('tags', function ($query) use ($tag_filter) {
    //       $query->where('slug', $tag_filter);
    //     });
    //   }
    //   $screenings_query = $screenings_query->whereHas('tags', function ($query) use ($tag_filter) {
    //     $query->where('slug', $tag_filter);
    //   });
    // }

    // Run the queries
    $screenings = $screenings_query->get();
    if($week == 1) {
      $screenings_today = $screenings_today_query->get();
    }
    else {
      $screenings_today = null;
    }

    return view('listings.weekly', compact('screenings','week','week_commencing','week_ending','screenings_today'));
  }

  public function addScreening(ScreeningRequest $request) {

    $screening = Screening::create($request->validated());

    if(isset($request->validated()['tags'])) {
      $screening = Screening::find($screening->fresh()->id);
      $screening->tags()->saveMany(Tag::find($request->validated()['tags']));
    }

    return response()->json($screening->fresh());

  }

  public function deleteScreening(Request $request) {
    $screening = Screening::find( $request->id );
    $screening->tags()->detach();
    $screening->delete();
    return response()->json();
  }
}
