<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Contracts\View\View;


class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  /**
   * Time
   */
  // Rewind time 30s. We want to show films that have recently started.
  protected $today;

  public function __construct()
    {
      define('DAYINSECONDS', 86400);
      $this->today = time() - (60 * 30);
    }
}
