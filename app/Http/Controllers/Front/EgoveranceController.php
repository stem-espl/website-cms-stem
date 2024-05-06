<?php

namespace App\Http\Controllers\Front;

use App\Models\BasicExtra;
use App\Models\EGovernanceModel;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class EgoveranceController extends Controller
{

  public function index(){
    $egovernance=EGovernanceModel::where('status',1)->get();
    return view('front.egoverance.egoverance',compact('egovernance'));
  }

}
