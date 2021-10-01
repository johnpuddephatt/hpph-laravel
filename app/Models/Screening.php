<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Screening extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'screenings';
    // protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['film_id','date','time','url'];
    // protected $hidden = [];
    protected $dates = ['date'];
    protected $dateFormat = 'Y/m/d';
    // protected $casts = [
    //   'date' => 'date',
    // ];

    protected static function boot()
    {
      parent::boot();
      static::saved(function() {
        \Cache::forget('homeHydeSeek');
      });
    }
    /*
    |-----------------------------------------------------  ---------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function film()
    {
      return $this->belongsTo('App\Models\Film');
    }

    public function tags()
    {
      return $this->belongsToMany('App\Models\Tag');
    }

    public function getURL()
    {
      if (strpos($this->url, 'S') === 0) {
        return config('app.spectrix') . ltrim($this->url, 'S') . '&resize=true';
      }
      elseif (is_numeric($this->url)) {
        return config('app.jack_roe') . $this->url;
      }
      else {
        return $this->url;
      }
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeLaterToday($query) {
      $today = time() - (60 * 30);
      return $query->where([['date','=',date("Y/m/d",$today)],['time','>',date("H:i",$today)]]);
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
