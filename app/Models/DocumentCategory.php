<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategory extends Model
{

  use SoftDeletes;
  protected $table = 'document_categories';

  protected $fillable = [
    'name',
    'status',
  ];

  public function documents()
  {
    return $this->hasMany('App\Models\Document', 'id', 'document_category_id');
  }
}
