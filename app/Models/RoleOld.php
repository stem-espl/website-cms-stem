<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleOld extends Model
{
    protected $table = 'roles_old';
    public function admins() {
      return $this->hasMany('App\Models\Admin');
    }
}
