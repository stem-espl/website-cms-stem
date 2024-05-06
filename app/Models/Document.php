<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{

  use SoftDeletes;
  protected $table = 'documents';

  public function tenderCategory()
  {
    return $this->belongsTo('App\Models\DocumentCategory', 'document_category_id', 'id');
  }
}
