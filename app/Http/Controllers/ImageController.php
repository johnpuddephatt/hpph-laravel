<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\ImageManagerStatic as Image;



class ImageController extends Controller
{
  public function default($config_string,$image) {

    $a = explode(',', $config_string);
    foreach ($a as $result) {
        $b = explode('_', $result);
        $config[$b[0]] = $b[1];
    }

    $config['f'] = pathinfo($image, PATHINFO_EXTENSION);

    if ( !in_array($config['f'], array('jpg','jpeg','png','webp'), true ) ) abort('404');

    if(!isset($config['q'])) {
      $config['q'] = config('imagecache.quality');
    }


    $src = url($image);
    $img = Image::cache(function($image) use ($src,$config) {


      $image->make($src);

      // Resize or crop
      if(isset($config['w']) && isset($config['h'])) {
        $g = isset($config['g']) ? $config['g'] : null;
        $image->fit($config['w'], $config['h'],null,$g);
      }
      elseif (isset($config['w'])) {
        $image->widen($config['w']);
      }
      elseif (isset($config['h'])) {
        $image->heighten($config['h']);
      }

      // Size and format

      if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {
        $image->encode('webp', $config['q']);
      }
      else {
        $image->encode($config['f'], $config['q']);
      }
    });

    if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {
      return Response::make($img, 200, array('Content-Type' => 'image/webp'));
    }
    elseif($config['f'] == 'jpg' || $config['f'] == 'jpeg' ) {
      return Response::make($img, 200, array('Content-Type' => 'image/jpeg'));
    }
    elseif($config['f'] == 'png') {
      return Response::make($img, 200, array('Content-Type' => 'image/png'));
    }


  }
}
