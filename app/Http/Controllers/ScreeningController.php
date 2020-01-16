<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

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

    $day_in_seconds = 86400;
    // Check week value is in range
    if($week < 1 || $week > 8) abort(404);

    // rewind time by 30 minutes to include films which have just started.
    $today = time() - (60 * 30);
    $today_date = date("Y/m/d",$today);
    $today_time = date("H:i",$today);

    // First week; collect today screenings separately
    if($week == 1) {
      $week_commencing = date("Y/m/d",$today + $day_in_seconds);
      $screenings_today_query = Screening::where([['date','=',$today_date],['time','>',$today_time]])->with(['film.strands','film.venue','tags'])->orderBy('date')->orderBy('time');
    }
    // Other weeks
    else {
      $week_commencing = date("Y/m/d",time() + (($week - 1) * 7) * $day_in_seconds);
    }

    // For all weeks
    $week_ending = date("Y/m/d",time() + ((($week - 1) * 7) + 6) * $day_in_seconds);
    $screenings_query = Screening::whereBetween('date',[$week_commencing,$week_ending])->with(['film.strands','film.venue','tags'])->orderBy('date')->orderBy('time');

    // Apply the filter(s)
    if($tag_filter) {
      if($week == 1) {
        $screenings_today_query = $screenings_today_query->whereHas('tags', function ($query) use ($tag_filter) {
          $query->where('slug', $tag_filter);
        });
      }
      $screenings_query = $screenings_query->whereHas('tags', function ($query) use ($tag_filter) {
        $query->where('slug', $tag_filter);
      });
    }

    // Run the queries
    $screenings = $screenings_query->get();
    if($week == 1) $screenings_today = $screenings_today_query->get();

    return view('listings.weekly', compact('screenings','week','week_commencing','week_ending','screenings_today'));
  }

  public function addScreening(Request $request) {
    $rules = array(
      'film_id' => 'required',
      'date' => 'required',
      'time' => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()) {
      return Response::json(array(
        'errors' => $validator->getMessageBag()->toArray()
      ));
    }
    else {
      $data = new Screening();
      $data->film_id = $request->film_id;
      $data->date = $request->date;
      $data->time = $request->time;
      $data->url = $request->url;

      $data->save();

      if($request->tags) {
        $tag_list=array();
        foreach($request->tags as $tag_id) {
          $tag = Tag::find($tag_id);
          $data->tags()->save($tag);
          array_push($tag_list, $tag->title);
        }

        $data->tags = $tag_list;
      }


      return response()->json($data);
    }
  }

  public function deleteScreening(Request $request) {
    $screening = Screening::find( $request->id );
    $screening->tags()->detach();
    $screening->delete();
    return response()->json();
  }
}
