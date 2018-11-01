<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Menu extends Model
{
  use CrudTrait;
  protected $table = 'menus';
  protected $fillable = ['title','entries'];

  protected $casts = [
    'entries' => 'array',
  ];
}
