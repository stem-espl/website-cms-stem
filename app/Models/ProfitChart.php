<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProfitChart extends Model
{
    use SoftDeletes, HasFactory;
    protected $table = 'profit_chart';
}
