<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leadership extends Model
{
  public function articleCategory() {
    return $this->belongsTo('App\Models\LeadCategory');
  }

  public function language() {
    return $this->belongsTo('App\Models\Language');
  }
}
