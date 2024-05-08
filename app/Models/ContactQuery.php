<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactQuery extends Model
{

  use SoftDeletes;
  protected $table = 'contact_query';

//   protected $fillable = [
//     'name',
//     'status',
//   ];

  
}
