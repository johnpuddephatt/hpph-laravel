<?php

namespace App\Http\Controllers;

use App\Models\Pick;
use App\Http\Controllers\Controller;

class PickController extends Controller
{
    public function index()
    {
      $picks = Pick::orderBy('date','DESC')->paginate(7);
      return view('picks', compact('picks'));
    }
}