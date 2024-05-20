<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Tender;
use App\Models\TenderCategory;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\LeadCategory;
use App\Models\DocumentCategory;
use App\Models\History;
use App\Models\Document;
use App\Models\WaterTeriff;
use App\Models\TariffDate;
use App\Models\Leadership;
use App\Models\ContactQuery;
use App\Models\BasicSetting;
use App\Models\ProfitChart;
use App\Models\BasicExtra;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

          $date = date('Y-m-d');

          Tender::whereDate('deadline','<',$date)->where('status','1')->update(['status' => '0']);

          if($lang_code == 'mr')
          {
            $data['tenders'] = Tender::select('tenders.title_mr as title','tenders.description_mr as description','tenders.files','tenders.id','tenders.tender_link','tender_category.name_mr as name');
          }else{
            $data['tenders'] = Tender::select('tenders.title','tenders.description','tenders.files','tenders.id','tenders.tender_link','tender_category.name');
          }

          $data['tenders'] = $data['tenders']->leftJoin('tender_category','tenders.tender_category','=','tender_category.id')
                                            ->where('tenders.status','1')
                                            // ->where('tender_category.status','1')
                                            ->whereNull('tender_category.deleted_at')
                                            ->orderBy('tenders.id','DESC')
                                            ->paginate(10);

          return view('front.stem.tenders',$data);
      }

      public function index(){
        if (session()->has('lang')) {
             $currentLang = Language::where('code', session()->get('lang'))->first();
            } else {
              $currentLang = Language::where('is_default', 1)->first();
           }        
         $lang_code = isset($currentLang->code) ?  $currentLang->code : 'en';
         $language = Language::where('code', $lang_code)->first();
         $data=News::where('language_id', $language->id)->get();
         
         return view('front.stem.news',compact('data'));
      }

      public function profitReport()
      {
        $data = [];
        $profits = ProfitChart::orderBy('label','ASC')->get();
        foreach ($profits as $key => $value) {
          $data['label'][] = $value->label;
          $data['amt'][] = $value->amount;
        }
        $data['count'] = count($profits);
         return view('front.stem.profit', $data);
      }

      public function showLeadership($slug){

        $category = LeadCategory::where('slug', $slug)->firstOrFail();
        $leadership = Leadership::where('category_id', $category->id)->where('status','1')->get();
        $name=$category->name;
        return view('front.stem.executive',compact('leadership','name'));
      }

      public function storeContactQuery(Request $request) {
        $validator =  Validator::make($request->all(),[
          'name' => 'required|string|max:255',
          'email' => 'required|email|max:255|unique:contact_query',
          'phone' => 'required|numeric|regex:/^[0-9]{10}$/|unique:contact_query',
          'message' => 'required',
          
        ], [
          'phone.unique' => 'The Pnone Number field has already been taken.',
          'email.unique' => 'The Email field has already been taken.',
      ]);

        if($validator->fails()){
          return back()->withErrors($validator)->withInput();
        };

          $contact = new ContactQuery;
          $contact->name = $request->name;
          $contact->email = $request->email;
          $contact->phone = $request->phone;
          $contact->message = $request->message;
          $contact->status = '0';
          $contact->save();
          return back();
      }
      public function contactUs()
      {
          if (session()->has('lang')) {
              $currentLang = Language::where('code', session()->get('lang'))->first();
          } else {
              $currentLang = Language::where('is_default', 1)->first();
          }
          $lang_code = isset($currentLang->code) ?  $currentLang->code : 'en';
          $language = Language::where('code', $lang_code)->first();
          $bs=BasicSetting::where('language_id', $language->id)->get(['contact_form_title','contact_form_subtitle',]);
          $bex=BasicExtra::where('language_id', $language->id)->get(['contact_addresses','contact_numbers','contact_mails','latitude','longitude']);
          return view('front.stem.contact-us',compact('bex','bs'));
      }

      
      public function circular($slug)
      {

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $lang_code = isset($currentLang->code) ?  $currentLang->code : 'en';

        $category = DocumentCategory::where('slug', $slug)->firstOrFail();
          
        if($lang_code == 'mr')
        {
            $document = Document::select('id','document_category_id','name_mr as name','files');
        }else{
            $document = Document::select('id','document_category_id','name','files');
        }
        $document = $document->where('document_category_id',$category->id)
                             ->where('status','1')
                             ->get();
        $variable=$category->name;

        return view('front.stem.circular',compact('document','variable'));
      }

      public function history(){
          if (session()->has('lang')) {
              $currentLang = Language::where('code', session()->get('lang'))->first();
            } else {
               $currentLang = Language::where('is_default', 1)->first();
            }
        $lang_code = isset($currentLang->code) ?  $currentLang->code : 'en';
        $language = Language::where('code', $lang_code)->first();
        $historyData=History::where('language_id', $language->id)->where('status','1')->get();
        return view('front.stem.history',compact('historyData'));
      }

      public function details( $id,Request $request){
        $data = News::findOrFail($id); 
        return view('front.stem.newsdetails',compact('data'));
      }

      public function waterTariff(){
      if (session()->has('lang')) {
        $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
          $currentLang = Language::where('is_default', 1)->first();
        }
        $lang_code = isset($currentLang->code) ?  $currentLang->code : 'en';
        $language = Language::where('code', $lang_code)->first();
        $data = WaterTeriff::where('language_id', $language->id)->get(); 
        $tdate = TariffDate::where('status',1)->first();
        $date = Carbon::parse($tdate->tdate)->format('d-m-Y');
        // dd($date);
        return view('front.stem.watertariff',compact('data','date'));
      }
}
