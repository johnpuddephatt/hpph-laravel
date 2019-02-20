<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Slide extends Model
{
  use CrudTrait;
  protected $table = 'slides';
  protected $fillable = ['title','type','active','film_id','strand_id','season_id','thumb','pretitle','heading','subheading','url'];

  public function film()
  {
    return $this->belongsTo('App\Models\Film');
  }

  public function season()
  {
    return $this->belongsTo('App\Models\Season');
  }

  public function strand()
  {
    return $this->belongsTo('App\Models\Strand');
  }

  protected $casts = [
    'active' => 'boolean',
  ];

  public function getRelatedItem($type, $id) {
    return $type::find($id);
  }

  public function getHeading() {
    if($this->heading) {
      return $this->heading;
    }
    elseif (class_exists($this->type)) {
      $this_related_id = ($this[lcfirst(class_basename($this->type)) . '_id']);
      // $related_item = $this->type::find($this_related_id);
      $related_item = $this->getRelatedItem($this->type, $this_related_id);
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
      // $related_item = $this->type::find($this_related_id);
      $related_item = $this->getRelatedItem($this->type, $this_related_id);

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
    elseif (class_exists($this->type)) {
      $this_related_id = ($this[lcfirst(class_basename($this->type)) . '_id']);

      if($this->type == 'App\Models\Film') {
        $related_item = $this->type::where('id',$this_related_id)->hasFutureScreenings()->with(['screenings' => function ($query) {
          $query->where('date', '>=', date('Y/m/d'))->orderBy('date')->orderBy('time');
        }])->first();
        if($related_item) {
          return $related_item->getDateRange();
        } else {
          return 'Find out more';
        }
      }
      else {
        $related_item = $this->type::find($this_related_id);
        return $related_item->short_description;
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


  public function setThumbAttribute($value)
    {
      $attribute_name = "thumb";
      $disk = "public";
      $destination_path = "thumbnails";

      // if the image was erased
      if ($value==null) {
          // delete the image from disk
          \Storage::disk($disk)->delete($this->{$attribute_name});
          // set null in the database column
          $this->attributes[$attribute_name] = null;
      }

      // if a base64 was sent, store it in the db
      if (starts_with($value, 'data:image'))
      {
          // 0. Make the image
          $image = \Image::make($value);
          // 1. Generate a filename.
          $filename = md5($value.time()).'.jpg';
          // 2. Store the image on disk.
          \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
          // 3. Save the path to the database
          $this->attributes[$attribute_name] = '/storage/'.$destination_path.'/'.$filename;
      }
    }

}
