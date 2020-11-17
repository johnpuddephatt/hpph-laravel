<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Pick extends Model
{
  use CrudTrait;

  protected $fillable = ['title','date','image','description'];

  protected $table = 'picks';

  protected static function boot()
  {
    parent::boot();
    static::saved(function() {
      \Cache::forget('homePick');
    });
  }

  protected $casts = [
    'date' => 'date',
  ];

  protected $dates = ['date'];

  public function setImageAttribute($value)
    {
      $attribute_name = "image";
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
