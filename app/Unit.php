<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
  protected $table = 'units';
  protected $primaryKey = 'id';
  protected $guarded = [];
  public $timestamps = false;

  public function scopeSearchUnit($query, $request)
  {
    return $query->select('id')->where('name',$request);
  }
}
