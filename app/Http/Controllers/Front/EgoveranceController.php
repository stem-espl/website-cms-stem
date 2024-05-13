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

    if (session()->has('lang')) {
        $currentLang = Language::where('code', session()->get('lang'))->first();
    } else {
        $currentLang = Language::where('is_default', 1)->first();
    }
    $lang_code = isset($currentLang->code) ?  $currentLang->code : 'en';
    $language = Language::where('code', $lang_code)->first();
    $egovernance=EGovernanceModel::where('language_id', $language->id)->where('status',1)->get();
    

    return view('front.egoverance.egoverance',compact('egovernance'));
  }

}
