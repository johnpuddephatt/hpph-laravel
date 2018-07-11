<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;


class Film extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'films';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['title','subtitle','slug','certificate','thumb','description','short_description','runtime','buy_url','director','starring','country','language','f_rating','year','association','format','tickets'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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

    public function getDateRange() {
      $this->start_date = Carbon::parse($this->screenings->first()->date)->format('d F');
      $this->start_date_day = explode(' ', $this->start_date)[0];
      $this->start_date_month = last(explode(' ', $this->start_date));
      $this->end_date = Carbon::parse($this->screenings->last()->date)->format('d F');
      $this->end_date_month = last(explode(' ', $this->end_date));

      $date_range = $this->start_date_day . ' ';
      if ($this->start_date_month != $this->end_date_month || $this->start_date == $this->end_date ) {
        $date_range .= $this->start_date_month;
      }
      if ($this->start_date != $this->end_date) {
        $date_range .= '– ';
      }
      if ($this->start_date != $this->end_date) {
        $date_range .= $this->end_date;
      }
      return $date_range;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function screenings()
    {
      return $this->hasMany('App\Models\Screening');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
