<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCategory extends Model
{
  protected $table = 'lead_categories';
  public function galleryCategoryLang()
  {
    return $this->belongsTo('App\Models\Language');
  }

  public function leadershipImg()
  {
    return $this->hasMany('App\Models\Leadership', 'category_id', 'id');
  }
}
