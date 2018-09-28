<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Slide extends Model
{
  use CrudTrait;
  protected $table = 'slides';
  protected $fillable = ['title','type','active','film_id','thumb','heading','subheading','url'];

  public function film()
  {
    return $this->belongsTo('App\Models\Film');
  }

  protected $casts = [
    'active' => 'boolean',
  ];

  public function getHeading() {
    if($this->heading) {
      return $this->heading;
    }
    elseif (class_exists($this->type)) {
      $this_related_id = ($this[lcfirst(class_basename($this->type)) . '_id']);
      $related_item = $this->type::find($this_related_id);
      return $related_item->title;
    }
    else {
      return 'no title set';
    }
  }
  public function getUrl() {
    if($this->url) {
      return $this->url;
    }
    elseif (class_exists($this->type)) {
      $this_related_id = ($this[lcfirst(class_basename($this->type)) . '_id']);
      $related_item = $this->type::find($this_related_id);
      return lcfirst(class_basename($this->type)) . '/' . $related_item->slug;
    }
    else {
      return null;
    }
  }
  public function getSubheading() {
    if($this->subheading) {
      return $this->subheading;
    }
    elseif (lcfirst(class_basename($this->type)) == 'film') {
      $this_related_id = ($this['film_id']);
      $related_item = $this->type::where('id',$this_related_id)->with(['screenings' => function ($query) {
        $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time');
      }])->first();
      if($related_item->screenings->count()) {
        return $related_item->getDateRange();
      }
      else {
        return 'Find out more';
      }
    }
    else {
      return null;
    }
  }
  public function getThumb() {
    if($this->thumb) {
      return $this->thumb;
    }
    elseif (class_exists($this->type)) {
      $this_related_id = ($this[lcfirst(class_basename($this->type)) . '_id']);
      $related_item = $this->type::find($this_related_id);
      return $related_item->thumb;
    }
    else {
      return '//www.placehold.it/640/360';
    }
  }

}
