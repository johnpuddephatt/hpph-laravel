<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Models\Screening;

class ScreeningController extends Controller
{
  public function index() {
    $screenings = Screening::orderBy('date', 'ASC')->get();
    return view('home', compact('screenings'));
  }

  public function addScreening(Request $request) {
    $rules = array (
      'film_id' => 'required',
      'date' => 'required',
      'time' => 'required',
    );
    $validator = Validator::make ( Input::all(), $rules );
    if ($validator->fails ()) {
        return Response::json ( array (
          'errors' => $validator->getMessageBag()->toArray ()
        ) );
      }
    else {
      $data = new Screening ();
      $data->film_id = $request->film_id;
      $data->date = $request->date;
      $data->time = $request->time;
      $data->url = $request->url;
      $data->labels = $request->labels;
      $data->save ();
      return response ()->json ( $data );
    }
  }

  public function deleteScreening(Request $request) {
    Screening::find( $request->id )->delete ();
    return response ()->json ();
  }
}
