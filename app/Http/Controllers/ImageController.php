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

    // Load config
    $a = explode(',', $config_string);
    foreach ($a as $result) {
        $b = explode('_', $result);
        $config[$b[0]] = $b[1];
    }

    // Format
    $config['f'] = pathinfo($image, PATHINFO_EXTENSION);
    if ( !in_array($config['f'], array('jpg','jpeg','png','webp'), true ) ) abort('404');
    // if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) $config['f'] = 'webp';

    // Gravity
    $config['g'] = isset($config['g']) ? $config['g'] : null;
    // Height and width
    $config['w'] = isset($config['w']) ? $config['w'] : null;
    $config['h'] = isset($config['h']) ? $config['h'] : null;
    // Quality
    if(!isset($config['q'])) {
      $config['q'] = config('imagecache.quality');
    }

    //   if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {


    $src = url($image);

    $img = Image::cache(function($image) use($src,$config) {
      $image->make($src)->fit($config['w'], $config['h'], null, $config['g'])->encode($config['f'], $config['q']);
    }, 10, false);


    // if( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false ) {
    //   return Response::make($img, 200, array('Content-Type' => 'image/webp'));
    // }
    if($config['f'] == 'jpg' || $config['f'] == 'jpeg' ) {
      return Response::make($img, 200, array('Content-Type' => 'image/jpeg'));
    }
    elseif($config['f'] == 'png') {
      return Response::make($img, 200, array('Content-Type' => 'image/png'));
    }
    else {
      return abort('404');
    }

  }
}