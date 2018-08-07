<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Models\Screening;
use App\Models\Slide;

class HomeController extends Controller
{
  public function index($day = 1) {

    // Get slides
    $slides = Slide::where('active',true)->get();

    // Get screenings
    $today_date = date("Y/m/d",time());
    $today_time = date("H:i",time() - 1800);

    $screenings_today = Screening::where([['date','=',$today_date],['time','>',$today_time]])->with('film')->orderBy('date')->orderBy('time')->get();

    // Out of range; abort.
    if($day < 1 || $day > 7) abort(404);

    // On day one and there are screenings; get them.
    if($day == 1 && count($screenings_today)) {
      $screenings = $screenings_today;
    }
    // On day one but there are no screenings; skip day.
    elseif($day == 1) {
      $day++;
      $current_date = date("Y/m/d",time() + ($day - 1) * 86400);
      $screenings = Screening::where('date',$current_date)->with('film')->orderBy('date')->orderBy('time')->get();
    }
    // Not on first day
    else {
      $current_date = date("Y/m/d",time() + ($day - 1) * 86400);
      $screenings = Screening::where('date',$current_date)->with('film')->orderBy('date')->orderBy('time')->get();
    }

    return view('landing', compact('slides','screenings','day', 'screenings_today'));
  }

}