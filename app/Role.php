<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $table = "roles";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function users()
  {
    return $this->hasMany('App\User');
  }
}
