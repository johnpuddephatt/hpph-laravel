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

  public function getTitle($related_item) {
    return $related_item->title;
  }
  public function getUrl($related_item) {
    if(!$this->url) {
      $this->url = lcfirst(class_basename($this->type)) . '/' . $related_item->slug;
    }
  }
  public function getSubheading($related_item) {
    if(!$this->subheading) {
      if(class_basename($related_item) == 'Film') {
        $this->subheading = $related_item->getDateRange();
      }
      else {
        $this->subheading =  $related_item->short_description;
      }
    }
  }

  // This doesn't follow pattern of others (e.g. heading) because of a bug with setThumbAttribute
  public function relatedThumb($related_item) {
    if($this->thumb) {
      $this->related_thumb = $this->thumb;
    }
    else {
      $this->related_thumb = $related_item->thumb;
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
