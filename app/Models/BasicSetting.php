<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class BasicSetting extends Model implements Auditable
{
    use  AuditableTrait;
    public $timestamps = false;


 protected $table = 'basic_settings';
    public function language() {
        return $this->belongsTo('App\Models\Language');
    }
}
