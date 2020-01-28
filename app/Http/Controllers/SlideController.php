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
  public function toggleActive(Slide $slide, $state) {
      $slide->active = ($state == 'activate' ? true : false);
      $slide->save();
  }
}
