<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtra;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class DocumentController extends Controller
{
  public function index(Request $request)
  {
  	if(!empty($request->language))
    	$lang = Language::where('code', $request->language)->first();
    else
    	$lang = Language::where('is_default', 1)->first();
    $lang_id = $lang->id;
    $data['documents'] = Document::orderBy('id', 'DESC')->paginate(10);
    $data['lang_id'] = $lang_id;

    $data['category']=DocumentCategory::select('name')->get();
    return view('admin.document.index',$data);
  }

  public function add(Request $request)
  {
  	if(!empty($request->language))
    	$lang = Language::where('code', $request->language)->first();
    else
    	$lang = Language::where('is_default', 1)->first();
    $lang_id = $lang->id;
    $lang_code = $lang->code;
    $data['category']=DocumentCategory::select('id','name')->get();
    if($lang_code == 'mr')
    	$data['documentCat'] = DocumentCategory::select('id','name_mr as title')->where('status','1')->orderBy('title', 'ASC')->get();
    else
    	$data['documentCat'] = DocumentCategory::select('id','name as title')->where('status','1')->orderBy('title', 'ASC')->get();

    return view('admin.document.add', $data);
  }

  public function store(Request $request)
  {
  		$request->validate([
            'title' => 'required|max:255',
            'title_mr' => 'required|max:255',
            'status' => 'required',
        ],[
        	'title.required' => 'The title in english field is required.',
        	'title_mr.required' => 'The title in marathi field is required.',
        	'file.required' => 'The document is required.',
        ]);
  		$document = new Document();
  		// $document->document_category_id = $request->document_category_id;
  		if ($request->hasFile('files')) {
          $file = $request->file('files');
          $rand = rand(000,999);
          $filename = $rand.'-'.time() . '.' . $file->getClientOriginalExtension();
          $request->file('files')->move('assets/stem/documents/', $filename);
          $document->files = $filename;
      }

      $document->document_category_id = $request->document_category;
      $document->name = $request->title;
      $document->name_mr = $request->title_mr;
      $document->status = $request->status;
      $document->save();
  		Session::flash('success', 'Documents added successfully!');
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
    	$data['documentCat'] = DocumentCategory::select('id','name')->get();
    else
    	$data['documentCat'] = DocumentCategory::select('id','name')->get();

    $data['document'] = Document::findOrFail($id);
    $data['category'] = DocumentCategory::select('id','name')->get();
    return view('admin.document.edit', $data);
  }

  public function update(Request $request)
  {
  		$request->validate([
            'title' => 'required|max:255',
            'title_mr' => 'required|max:255',
            'status' => 'required',
            'documents' => 'required|max:2048|mimes:application/pdf,pdf',
        ],[
          'title.required' => 'The title in english field is required.',
          'title_mr.required' => 'The title in marathi field is required.',
          'documents.required' => 'The document is required.',
        ]);


  		$document = Document::findOrFail($request->tender_id);
  		$document->document_category_id = $request->document_category_id;
  		if ($request->hasFile('documents')) {
          $file = $request->file('documents');
          $rand = rand(000,999);
          $filename = $rand.'-'.time() . '.' . $file->getClientOriginalExtension();
          $request->file('documents')->move('assets/stem/documents/', $filename);
          if(!empty($document->files))
                @unlink('assets/stem/documents/' . $document->files);
          $document->files = $filename;
      }

      $document->title = $request->title;
      $document->title_mr = $request->title_mr;
      $document->status = $request->status;
      $document->save();

  		Session::flash('success', 'Document updated successfully!');
      return "success";
  }

  public function delete(Request $request)
  {
      $tender = Document::findOrFail($request->tender_id);
      $tender->delete();
      Session::flash('success', 'Document deleted successfully!');
      return back();
  }

  public function bulkDelete(Request $request)
  {
      $ids = $request->ids;

      foreach ($ids as $id) {
          $tender = Document::findOrFail($id);
          $tender->delete();
      }

      Session::flash('success', 'Documents deleted successfully!');
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
    	$data['documentCat'] = DocumentCategory::select('id','status','name_mr','name','name_mr as title','slug')->orderBy('id', 'DESC')->paginate(10);
    else
    	$data['documentCat'] = DocumentCategory::select('id','status','name_mr','name','name as title','slug')->orderBy('id', 'DESC')->paginate(10);
    $data['lang_id'] = $lang_id;

    return view('admin.document.category.index', $data);
  }

  public function category_store(Request $request)
  {
  	$messages = [
            'name.required' => 'The name in english is required',
            'name_mr.required' => 'The name in marathi is required',
        ];

        $rules = [
            'name' => 'required|max:255|unique:document_categories,name',
            'name_mr' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $tcategory = new DocumentCategory;
        $tcategory->name = $request->name;
        $tcategory->name_mr = $request->name_mr;
        $tcategory->status = $request->status;
        $tcategory->slug =Str::slug($request->name.'-'.rand(10,10042), '-');
        $tcategory->save();
        Session::flash('success', 'Document category added successfully!');
        return "success";
  }

  public function category_update(Request $request)
  {
  	$messages = [
            'name.required' => 'The name in english is required',
            'name_mr.required' => 'The name in marathi is required',
        ];
      $rules = [
          'name' => 'required|max:255|unique:document_categories,name',
          'name_mr' => 'required|max:255',
          'status' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
          $errmsgs = $validator->getMessageBag()->add('error', 'true');
          return response()->json($validator->errors());
      }

      $tcategory = DocumentCategory::findOrFail($request->dcategory_id);

      $tcategory->name = $request->name;
      $tcategory->name_mr = $request->name_mr;
      $tcategory->status = $request->status;
      $tcategory->save();

      Session::flash('success', 'Document category updated successfully!');
      return "success";
  }

  public function category_delete(Request $request)
  {
      $tcategory = DocumentCategory::findOrFail($request->tcategory_id);
      if ($tcategory->documents()->count() > 0) {
          Session::flash('warning', 'First, delete all the documents under this category!');
          return back();
      }

      $tcategory->delete();
      Session::flash('success', 'Documents category deleted successfully!');
      return back();
  }

  public function category_bulkDelete(Request $request)
  {
      $ids = $request->ids;

      foreach ($ids as $id) {
          $tcategory = DocumentCategory::findOrFail($id);
          if ($tcategory->tenders()->count() > 0) {
              Session::flash('warning', 'First, delete all the documents under the selected categories!');
              return "success";
          }
      }

      foreach ($ids as $id) {
          $tcategory = DocumentCategory::findOrFail($id);
          $tcategory->delete();
      }

      Session::flash('success', 'Documents categories deleted successfully!');
      return "success";
  }

}
