<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtra;
use App\Models\Tender;
use App\Models\TenderCategory;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class TendersController extends Controller
{
  public function index(Request $request)
  {
  	if(!empty($request->language))
    	$lang = Language::where('code', $request->language)->first();
    else
    	$lang = Language::where('is_default', 1)->first();
    $lang_id = $lang->id;

    $data['tenders'] = Tender::orderBy('id', 'DESC')->paginate(10);

    $data['lang_id'] = $lang_id;

    return view('admin.tender.index', $data);
  }

  public function add(Request $request)
  {
  	if(!empty($request->language))
    	$lang = Language::where('code', $request->language)->first();
    else
    	$lang = Language::where('is_default', 1)->first();
    $lang_id = $lang->id;
    $lang_code = $lang->code;

    if($lang_code == 'mr')
    	$data['tendersCat'] = TenderCategory::select('id','name_mr as title')->where('status','1')->orderBy('title', 'ASC')->get();
    else
    	$data['tendersCat'] = TenderCategory::select('id','name as title')->where('status','1')->orderBy('title', 'ASC')->get();

    return view('admin.tender.add', $data);
  }

  public function store(Request $request)
  {
  		$request->validate([
            // 'tender_category' => 'required',
            'title' => 'required|max:255',
            'title_mr' => 'required|max:255',
            'description' => 'required',
            'description_mr' => 'required',
            'tender_link' => 'nullable',
            'status' => 'required',
            'tender_doc' => 'required|max:2048|mimes:application/pdf,pdf',
            'deadline' => 'nullable|after_or_equal:' . date('Y-m-d'),
        ],[
        	'title.required' => 'The title in english field is required.',
        	'title_mr.required' => 'The title in marathi field is required.',
        	'description.required' => 'The description in english field is required.',
        	'description_mr.required' => 'The description in marathi field is required.',
        	'tender_doc.required' => 'The tender document is required.',
        ]);


  		$tender = new Tender();
  		$tender->tender_category = isset($request->tender_category) ? $request->tender_category : null;
  		if ($request->hasFile('tender_doc')) {
          $file = $request->file('tender_doc');
          $rand = rand(000,999);
          $filename = $rand.'-'.time() . '.' . $file->getClientOriginalExtension();
          $request->file('tender_doc')->move('assets/stem/tenders/', $filename);
          $tender->files = $filename;
      }

      $tender->title = $request->title;
      $tender->title_mr = $request->title_mr;
      $tender->description = $request->description;
      $tender->description_mr = $request->description_mr;
      $tender->tender_link = isset($request->tender_link) ? $request->tender_link : null;
      $tender->status = $request->status;
      $tender->deadline = isset($request->deadline) ? $request->deadline : null;

      $tender->save();

  		Session::flash('success', 'Tender added successfully!');
      return "success";
  }

  public function edit($id, Request $request)
  {
  	if(!empty($request->language))
    	$lang = Language::where('code', $request->language)->first();
    else
    	$lang = Language::where('is_default', 1)->first();
    $lang_id = $lang->id;
    $lang_code = $lang->code;

    if($lang_code == 'mr')
    	$data['tendersCat'] = TenderCategory::select('id','name_mr as title')->orderBy('title', 'ASC')->get();
    else
    	$data['tendersCat'] = TenderCategory::select('id','name as title')->orderBy('title', 'ASC')->get();

    $data['tender'] = Tender::findOrFail($id);

    return view('admin.tender.edit', $data);
  }

  public function update(Request $request)
  {
  		$request->validate([
            // 'tender_category' => 'required',
            'title' => 'required|max:255',
            'title_mr' => 'required|max:255',
            'description' => 'required',
            'description_mr' => 'required',
            'tender_link' => 'nullable',
            'status' => 'required',
            'tender_doc' => 'nullable|max:2048|mimes:application/pdf,pdf',
        ],[
        	'title.required' => 'The title in english field is required.',
        	'title_mr.required' => 'The title in marathi field is required.',
        	'description.required' => 'The description in english field is required.',
        	'description_mr.required' => 'The description in marathi field is required.',
        ]);


  		$tender = Tender::findOrFail($request->tender_id);
  		$tender->tender_category = isset($request->tender_category) ? $request->tender_category : null;
  		if ($request->hasFile('tender_doc')) {
          $file = $request->file('tender_doc');
          $rand = rand(000,999);
          $filename = $rand.'-'.time() . '.' . $file->getClientOriginalExtension();
          $request->file('tender_doc')->move('assets/stem/tenders/', $filename);
          if(!empty($tender->files))
                @unlink('assets/stem/tenders/' . $tender->files);
          $tender->files = $filename;
      }

      $tender->title = $request->title;
      $tender->title_mr = $request->title_mr;
      $tender->description = $request->description;
      $tender->description_mr = $request->description_mr;
      $tender->tender_link = isset($request->tender_link) ? $request->tender_link : null;
      $tender->status = $request->status;
      $tender->deadline = isset($request->deadline) ? $request->deadline : null;

      $tender->save();

  		Session::flash('success', 'Tender updated successfully!');
      return "success";
  }

  public function delete(Request $request)
  {
      $tender = Tender::findOrFail($request->tender_id);
      $tender->delete();
      Session::flash('success', 'Tender deleted successfully!');
      return back();
  }

  public function bulkDelete(Request $request)
  {
      $ids = $request->ids;

      foreach ($ids as $id) {
          $tender = Tender::findOrFail($id);
          $tender->delete();
      }

      Session::flash('success', 'Tenders deleted successfully!');
      return "success";
  }


  public function category_index(Request $request)
  {
  	if(!empty($request->language))
    	$lang = Language::where('code', $request->language)->first();
    else
    	$lang = Language::where('is_default', 1)->first();
    $lang_id = $lang->id;
    $lang_code = $lang->code;


    if($lang_code == 'mr')
    	$data['tendersCat'] = TenderCategory::select('id','status','name_mr','name','name_mr as title')->orderBy('id', 'DESC')->paginate(10);
    else
    	$data['tendersCat'] = TenderCategory::select('id','status','name_mr','name','name as title')->orderBy('id', 'DESC')->paginate(10);
    $data['lang_id'] = $lang_id;

    return view('admin.tender.category.index', $data);
  }

  public function category_store(Request $request)
  {
  	$messages = [
            'name.required' => 'The name in english is required',
            'name_mr.required' => 'The name in marathi is required',
        ];

        $rules = [
            'name' => 'required|max:255',
            'name_mr' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $tcategory = new TenderCategory;
        $tcategory->name = $request->name;
        $tcategory->name_mr = $request->name_mr;
        $tcategory->status = $request->status;
        $tcategory->save();

        Session::flash('success', 'Tender category added successfully!');
        return "success";
  }

  public function category_update(Request $request)
  {
  	$messages = [
            'name.required' => 'The name in english is required',
            'name_mr.required' => 'The name in marathi is required',
        ];
      $rules = [
          'name' => 'required|max:255',
          'name_mr' => 'required|max:255',
          'status' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
          $errmsgs = $validator->getMessageBag()->add('error', 'true');
          return response()->json($validator->errors());
      }

      $tcategory = TenderCategory::findOrFail($request->tcategory_id);
      $tcategory->name = $request->name;
      $tcategory->name_mr = $request->name_mr;
      $tcategory->status = $request->status;
      $tcategory->save();

      Session::flash('success', 'Tender category updated successfully!');
      return "success";
  }

  public function category_delete(Request $request)
  {
      $tcategory = TenderCategory::findOrFail($request->tcategory_id);
      if ($tcategory->tenders()->count() > 0) {
          Session::flash('warning', 'First, delete all the tenders under this category!');
          return back();
      }

      $tcategory->delete();
      Session::flash('success', 'Tender category deleted successfully!');
      return back();
  }

  public function category_bulkDelete(Request $request)
  {
      $ids = $request->ids;

      foreach ($ids as $id) {
          $tcategory = TenderCategory::findOrFail($id);
          if ($tcategory->tenders()->count() > 0) {
              Session::flash('warning', 'First, delete all the tenders under the selected categories!');
              return "success";
          }
      }

      foreach ($ids as $id) {
          $tcategory = TenderCategory::findOrFail($id);
          $tcategory->delete();
      }

      Session::flash('success', 'Tenders categories deleted successfully!');
      return "success";
  }

}
