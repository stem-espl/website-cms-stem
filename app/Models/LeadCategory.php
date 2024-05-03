<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCategory extends Model
{
  public function articles() {
    return $this->hasMany('App\Models\Leadership');
  }
}
