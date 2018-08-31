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
  public function future() {
    $screenings = Screening::where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time')->get();
    return view('home', compact('screenings'));
  }

  public function weekly($week = 1) {
    // $weekday = date("w") - 1;
    // if($weekday < 0)
    //   $weekday += 7;
    // $week_commencing = date("Y/m/d",time() +(($week - 1) * 7 - $weekday) * 86400);
    // $week_ending = date("Y/m/d",time() +((($week - 1) * 7) + 6 - $weekday) * 86400);

    if($week < 1 || $week > 8) abort(404);

    $today = time() - 1800;
    $today_date = date("Y/m/d",$today);
    $today_time = date("H:i",$today);

    // First week; collect today screenings separately
    if($week == 1) {
      $week_commencing = date("Y/m/d",time() + 86400);
      $screenings_today = Screening::where([['date','=',$today_date],['time','>',$today_time]])->with('film')->orderBy('date')->orderBy('time')->get();
    }
    // Other weeks
    else {
      $week_commencing = date("Y/m/d",time() +(($week - 1) * 7) * 86400);
    }

    $week_ending = date("Y/m/d",time() +((($week - 1) * 7) + 6) * 86400);




    $screenings = Screening::whereBetween('date',[$week_commencing,$week_ending])->with('film')->orderBy('date')->orderBy('time')->get();
    return view('film.weekly', compact('screenings','week','week_commencing','week_ending','screenings_today'));
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

    foreach($screening->tags as $tag) {

    }
    $screening->delete();
    return response()->json();
  }
}
