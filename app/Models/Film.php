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
      public $timestamps = true;
      // protected $guarded = ['id'];
      protected $fillable = ['title','subtitle','slug','certificate','thumb','trailer','embed','description','short_description','runtime','trailer_duration','custom_coming_soon','buy_url','director','starring','country','language','f_rating','year','association','format','tickets','alt_language_title','free','audio_description','reviews'];
      // protected $hidden = [];
      // protected $dates = [];
      protected $casts = [
        'reviews' => 'object',
        'trailer' => 'object'
      ];

      /*
      |--------------------------------------------------------------------------
      | FUNCTIONS
      |--------------------------------------------------------------------------
      */

      public function getIsOnlineAttribute()
      {
        return $this->strands->contains(config('app.watch_online_strand'));
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

      public function getDateRange() {
        if(count($this->screenings)) {
          $this->start_date = Carbon::parse($this->screenings->sortBy('date')->first()->date)->format('D jS F');
          $this->start_date_day = explode(' ', $this->start_date)[0];
          $this->start_date_dayname = explode(' ', $this->start_date)[1];
          $this->start_date_month = last(explode(' ', $this->start_date));
          $this->end_date = Carbon::parse($this->screenings->sortBy('date')->last()->date)->format('D jS F');
          $this->end_date_month = last(explode(' ', $this->end_date));

          $date_range = $this->start_date_day . ' ' . $this->start_date_dayname . ' ';
          if ($this->start_date_month != $this->end_date_month || $this->start_date == $this->end_date ) {
            $date_range .= $this->start_date_month;
          }
          if ($this->start_date != $this->end_date) {
            $date_range .= ' – ';
          }
          if ($this->start_date != $this->end_date) {
            $date_range .= $this->end_date;
          }
          if ($this->screenings->count() == 1) {
            $date_range .= ', ' . Carbon::parse($this->screenings->sortBy('date')->first()->time)->format('g.ia');
          }
        }
        else {
          $date_range = 'No screenings currently scheduled';
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

      public function venue()
      {
        return $this->belongsTo('App\Models\Venue');
      }

      public function strands()
      {
        return $this->belongsToMany('App\Models\Strand');
      }

      public function seasons()
      {
        return $this->belongsToMany('App\Models\Season');
      }

      /*
      |--------------------------------------------------------------------------
      | SCOPES
      |--------------------------------------------------------------------------
      */
      public function scopeHasFutureScreenings($query)
      {
        return $query->whereHas('screenings', function ($query) {
          $query->where('date', '>=', date('Y/m/d'));
        })->doesntHave('screenings', 'or');
      }

      public function scopeAtVenue($query, $venue)
      {
        if($venue) {
          return $query->where('venue_id', $venue->id);
        }
        else {
          return $query;
        }
      }
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
