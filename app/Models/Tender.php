<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{

  use SoftDeletes;
  protected $table = 'tenders';

  public function tenderCategory()
  {
    return $this->belongsTo('App\Models\TenderCategory', 'tender_category', 'id');
  }
}
