<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surveyor extends Model
{
  protected $table = 'surveyors';
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function checklists()
  {
      return $this->belongsToMany('App\Checklist','checklist_surveyor','surveyor_id','checklist_id')->withPivot('answer');
  }
  public function projects()
  {
      return $this->belongsTo('App\Project','project_id');
  }
}
