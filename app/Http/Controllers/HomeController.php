<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Models\Screening;
use App\Models\Slide;
use App\Models\Strand;
use App\Models\Tag;

class HomeController extends Controller
{
  public function index($day = 1) {

    /*
    ** SLIDES
    */

    $day_in_seconds = 86400;
    // Get slides
    $slides = Slide::where('active',true)->orderBy('lft', 'ASC')->get();

    // Get screenings
    $today = time() - (60 * 30);
    $today_date = date("Y/m/d",$today);
    $today_time = date("H:i",$today);

    // For screenings today we only include those which are in the future
    $screenings_today = Screening::where([['date','=',$today_date],['time','>',$today_time]])->with('film.strands')->orderBy('date')->orderBy('time')->get();

    // Out of range; abort.
    if($day < 1 || $day > 7) abort(404);

    // On day one and there are screenings; get them.
    if($day == 1 && count($screenings_today)) {
      $screenings = $screenings_today;
    }
    // On day one but there are no screenings; skip day.
    elseif($day == 1) {
      $day++;
      $current_date = date("Y/m/d",time() + ($day - 1) * $day_in_seconds);
      $screenings = Screening::where('date',$current_date)->with('film.strands')->orderBy('date')->orderBy('time')->get();
    }
    // Not on first day
    else {
      $current_date = date("Y/m/d",time() + ($day - 1) * $day_in_seconds);
      $screenings = Screening::where('date',$current_date)->with('film.strands')->orderBy('date')->orderBy('time')->get();
    }

    /*
    ** STRANDS
    */
    $strand_ids = explode(',', config('app.homepage_strands'));
    $strands = Strand::whereIn('id',$strand_ids)->get();


    /*
    ** TAGS
    */
    $tag_ids = explode(',', config('app.homepage_tags'));
    $tags = Tag::whereIn('id',$tag_ids)->get();

    return view('landing', compact('slides','screenings','day', 'screenings_today','strands','tags'));
  }

}