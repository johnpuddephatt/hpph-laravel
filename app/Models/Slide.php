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
      return 'http://www.placecage.com/1000/600';
    }
  }

}
