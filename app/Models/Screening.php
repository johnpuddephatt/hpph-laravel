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
    protected $fillable = ['film_id','date','time','labels','url'];
    // protected $hidden = [];
    protected $dates = ['date'];
    protected $dateFormat = 'Y/m/d';
    protected $casts = [
      'date' => 'date',
    ];
    /*
    |-----------------------------------------------------  ---------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function labels()
    {
        return explode(',',$this->labels);
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function film()
    {
      return $this->belongsTo('App\Models\Film');
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
