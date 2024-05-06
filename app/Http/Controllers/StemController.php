<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Tender;
use App\Models\TenderCategory;
use App\Models\Language;

class StemController extends Controller
{
      public function tenders(Request $request)
      {
          if (session()->has('lang')) {
              $currentLang = Language::where('code', session()->get('lang'))->first();
          } else {
              $currentLang = Language::where('is_default', 1)->first();
          }
          
          $lang_code = isset($currentLang->code) ? $currentLang->code : 'en';

          if($lang_code == 'mr')
          {
            $data['tenders'] = Tender::select('title_mr as title','description_mr as description','files','id','tender_link')->orderBy('id','DESC')->paginate(10);
          }else{
            $data['tenders'] = Tender::select('title','description','files','id','tender_link')->orderBy('id','DESC')->paginate(10);
          }

          return view('front.stem.tenders',$data);
      }

      public function index(){
        $data=News::all();
        return view('admin.calendar.news',compact('data'));
      }

      public function aboutus()
      {
         return view('front.stem.about');
      }

      public function profitReport()
      {
         return view('front.stem.profit');
      }
}
