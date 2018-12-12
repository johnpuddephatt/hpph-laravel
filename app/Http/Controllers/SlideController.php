<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;


use App\Models\Slide;

class SlideController extends Controller
{
  public function toggleActive($id,$state) {
    $slide = Slide::find($id);
    if($state == 'activate') {
      $slide->active = true;
      $slide->save();
    }
    elseif($state == 'deactivate') {
      $slide->active = false;
      $slide->save();
    }
    else {
      abort();
    }
  }
}
