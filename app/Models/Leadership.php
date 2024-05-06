<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leadership extends Model
{
  protected $table = 'leadership';
  public function leadCategory() {
    return $this->belongsTo('App\Models\LeadCategory');
  }

  public function language() {
    return $this->belongsTo('App\Models\Language');
  }

  public function LeaderImgCategory()
  {
    return $this->belongsTo('App\Models\LeadCategory', 'category_id', 'id');
  }
}
