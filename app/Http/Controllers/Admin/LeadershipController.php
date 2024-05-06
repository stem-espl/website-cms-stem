<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtra;
use App\Models\LeadCategory;
use App\Models\Leadership;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;


class LeadershipController extends Controller
{
 // Leadership Category Functions  
  public function index(Request $request)
  {
    $language = Language::where('code', $request->language)->first();

    $categories = LeadCategory::where('language_id', $language->id)
      ->orderBy('id', 'desc')
      ->paginate(10);

    return view('admin.leadership.categories', compact('categories'));
  }

  public function store(Request $request)
  {
      $rules = [
          'language_id' => 'required',
          'name' => 'required|unique:lead_categories,name',
          'status' => 'required',
        //   'serial_number' => 'required'
      ];
  
      $validator = Validator::make($request->all(), $rules);
  
      if ($validator->fails()) {
          $validator->getMessageBag()->add('error', 'true');
  
          return response()->json($validator->errors());
      }  
    
      $ramdam=rand(10,10042);
      $lead_category = new LeadCategory;
      $lead_category->language_id = $request->language_id;
      $lead_category->name = $request->name;
      $lead_category->status = $request->status;
    //   $lead_category->serial_number = $request->serial_number;
      $lead_category->slug =Str::slug($request->name.'-'.rand(10,10042), '-');
      $lead_category->save();
  
      Session::flash('success', 'New Leadership category added successfully.');
  
      return 'success';
  }
  public function update(Request $request)
  {
    // dd($request->all());
    $event = LeadCategory::findOrFail($request->categoryId);
    
    $rules = [
      'name' => 'required',
      'status' => 'required',
    //   'serial_number' => 'required'
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      $validator->getMessageBag()->add('error', 'true');

      return response()->json($validator->errors());
    }

   $event= LeadCategory::findOrFail($request->categoryId);
    $event->name = $request->name;
  
    $event->status = $request->status;
    $event->save();

    Session::flash('success', 'Leadership category updated successfully.');

    return 'success';
  }

  public function delete(Request $request)
  {
    $category = LeadCategory::findOrFail($request->categoryId);

    if ($category->leadershipImg->count() > 0) {
      Session::flash('warning', 'First delete all the images of this category');

      return redirect()->back();
    }

    $category->delete();

    Session::flash('success', 'Leadership category deleted successfully.');

    return redirect()->back();
  }

  public function bulkDelete(Request $request)
  {
    $ids = $request->ids;

    foreach ($ids as $id) {
      $category = LeadCategory::findOrFail($id);

      if ($category->leadershipImg->count() > 0) {
        Session::flash('warning', 'First delete all the images of those categories');

        return 'success';
      }
    }

    foreach ($ids as $id) {
      $category = LeadershipCategory::findOrFail($id);

      $category->delete();
    }

    Session::flash('success', 'Leadership categories deleted successfully.');

    return 'success';
  }



//   Leadership Functions

public function leadIndex(Request $request)
{
    // dd('hi');
  $lang = Language::where('code', $request->language)->first();

  $lang_id = $lang->id;
  $data['leaderships'] = Leadership::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();


  $data['lang_id'] = $lang_id;

  $data['categoryInfo'] = BasicExtra::first();

  return view('admin.leadership.index', $data);
}

public function getLeadCategories(Request $request)
{
    // dd($request->all());
    $langId = $request->langId;
  $lead_categories = LeadCategory::where('language_id', $langId)
    ->where('status', 1)
    ->get();
// dd($lead_categories);
  return $lead_categories;
}

public function leadEdit(Request $request, $id)
{
  $lang = Language::where('code', $request->language)->first();

  $data['categories'] = LeadCategory::where('language_id', $lang->id)
    ->where('status', 1)
    ->get();

  $data['leadership'] = Leadership::findOrFail($id);
  // dd($data['leadership']);

  $data['categoryInfo'] = BasicExtra::first();

  return view('admin.leadership.edit', $data);
}



public function leadStore(Request $request)
{
// dd($request->all());
  $image = $request->file;
  $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
  $messages = [
    'language_id.required' => 'The language field is required',
    'file.required' => 'The Image field is required',
  ];

  $rules = [
    'language_id' => 'required',
    'file' => 'required',
    'title' => 'required|max:255',
    'status' => 'required',
    // 'serial_number' => 'required|integer',/
  ];

  $validator = Validator::make($request->all(), $rules, $messages);

  if ($validator->fails()) {
    $errmsgs = $validator->getMessageBag()->add('error', 'true');
    return response()->json($validator->errors());
  }

  $leadership = new Leadership;

  if ($request->has('file')) {
    $destinationPath = '/assets/stem/leadership/'; 
    if(!File::exists(public_path($destinationPath))) {
      File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
    }
    $image = $request->file('file');
    $imagename= $image->getClientOriginalName();

    //image resize logic
    $new_image = Image::make($image->getRealPath());
    if($new_image != null){
        $filename = uniqid() .'.'. $request->file('file')->extension();
        $image_width= $new_image->width();
        $image_height= $new_image->height();
        $new_width= 720;
        $new_height= 480;
        $new_image->resize($new_width, $new_height);         
        $new_image->save( ('assets/stem/leadership/' .$filename));
        $leadership->image = $filename;
    }
}

  $leadership->language_id = $request->language_id;
  $leadership->name = $request->title;
//   $leadership->serial_number = $request->serial_number;
  $leadership->category_id = $request->category_id;
  $leadership->post = $request->postname;
  $leadership->status = $request->status;

  $leadership->save();

  Session::flash('success', 'Image added successfully!');
  return "success";
}


public function leadupdate(Request $request)
{
  // dd($request->all());
    $event = Leadership::find($request->leadership_id);
    if(!empty($event))
    {
        $image = $request->image;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extImage = pathinfo($image, PATHINFO_EXTENSION);

        $rules = [
          'title' => 'required|max:255',
        // 'serial_number' => 'required|integer',
        ];

        if ($request->has('image')) {
            $rules['image'] = [
                'mimes:jpeg,jpg,png,svg',
            ];
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        if ($request->has('image')) {
            $destinationPath = '/assets/stem/leadership/'; 
            if(!File::exists(public_path($destinationPath))) {
              File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }
            $image = $request->file('image');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
                @unlink('assets/stem/leadership/' . $event->image);
                $filename = uniqid() .'.'. $request->file('image')->extension();
                $image_width= $new_image->width();
                $image_height= $new_image->height();
                $new_width= 720;
                $new_height= 480;
                $new_image->resize($new_width, $new_height);         
                $new_image->save(public_path('assets/stem/leadership/' .$filename));
                $event->image = $filename;
            }
        }
        
        $event->name = $request->title;
        $event->post = $request->postname;
        $event->category_id = $request->category_id;
        $event->status = $request->status;
        $event->save();
    
        Session::flash('success', 'Leadership updated successfully!');
        
    }else{
        Session::flash('error', 'Leadership not found');
    }
    return "success";
}

public function leadDelete(Request $request)
{

  $leadership = Leadership::findOrFail($request->leadership_id);
  @unlink('assets/stem/leadership/' . $leadership->image); 
  $leadership->delete();

  Session::flash('success', 'Image deleted successfully!');
  return back();
}

public function bulkLeadDelete(Request $request)
{
  $ids = $request->ids;

  foreach ($ids as $id) {
    $leadership = Leadership::findOrFail($id);
    @unlink('assets/stem/leadership/' . $leadership->image);
    $leadership->delete();
  }

  Session::flash('success', 'Image deleted successfully!');
  return "success";
}

}