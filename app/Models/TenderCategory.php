<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenderCategory extends Model
{

  use SoftDeletes;
  protected $table = 'tender_category';

  protected $fillable = [
    'name',
    'name_mr',
    'status',
  ];

  public function tenders()
  {
    return $this->hasMany('App\Models\Tender', 'id', 'tender_category');
  }
}
