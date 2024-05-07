<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtra;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class GalleryController extends Controller
{
  public function index(Request $request)
  {
    // $lang = Language::where('code', $request->language)->first();
    $lang_code = isset($request->language) ?  $request->language : 'en';
    $lang = Language::where('code', $lang_code)->first();

    $lang_id = $lang->id;
    $data['galleries'] = Gallery::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();

    $data['lang_id'] = $lang_id;

    $data['categoryInfo'] = BasicExtra::first();

    return view('admin.gallery.index', $data);
  }

  public function edit(Request $request, $id)
  {
    $lang = Language::where('code', $request->language)->first();

    $data['categories'] = GalleryCategory::where('language_id', $lang->id)
      ->where('status', 1)
      ->get();

    $data['gallery'] = Gallery::findOrFail($id);

    $data['categoryInfo'] = BasicExtra::first();

    return view('admin.gallery.edit', $data);
  }

  public function getCategories($langId)
  {
    $gallery_categories = GalleryCategory::where('language_id', $langId)
      ->where('status', 1)
      ->get();

    return $gallery_categories;
  }

  public function store(Request $request)
  {

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
      'serial_number' => 'required|integer',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      $errmsgs = $validator->getMessageBag()->add('error', 'true');
      return response()->json($validator->errors());
    }

    $gallery = new Gallery;

    if ($request->has('file')) {
      $destinationPath = '/assets/stem/gallery/'; 
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
          $new_image->save( ('assets/stem/gallery/' .$filename));
          $gallery->image = $filename;
      }
  }

    $gallery->language_id = $request->language_id;
    $gallery->title = $request->title;
    $gallery->serial_number = $request->serial_number;
    $gallery->category_id = $request->category_id;

    $gallery->save();

    Session::flash('success', 'Image added successfully!');
    return "success";
  }



  // public function update(Request $request)
  // {
  //   $categoryInfo = BasicExtra::first();

  //   $message = [];

  //   if ($categoryInfo->gallery_category_status == 1) {
  //     $message['category_id.required'] = 'The category field is required';
  //   }

  //   $gallery = Gallery::find($request->gallery_id);
  //   $image = $request->image;
  //   $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
  //   $extImage = pathinfo($image, PATHINFO_EXTENSION);

  //   $rules = [
  //     'title' => 'required|max:255',
  //     'serial_number' => 'required|integer',
  //   ];

  //   if ($categoryInfo->gallery_category_status == 1) {
  //     $rules['category_id'] = 'required';
  //   }

  //   if ($request->filled('image')) {  
  //     $rules['image'] = [
  //       function ($attribute, $value, $fail) use ($extImage, $allowedExts) {
  //         if (!in_array($extImage, $allowedExts)) {
  //           return $fail("Only png, jpg, jpeg, svg image is allowed");
  //         }
  //       }
  //     ];
  //   }

  //   $validator = Validator::make($request->all(), $rules);

  //   if ($validator->fails()) {
  //     $errmsgs = $validator->getMessageBag()->add('error', 'true');
  //     return response()->json($validator->errors());
  //   }

  //   $gallery = Gallery::findOrFail($request->gallery_id);
  //   $gallery->title = $request->title;
  //   $gallery->serial_number = $request->serial_number;
  //   $gallery->category_id = $request->category_id;

  //   if ($request->filled('image')) {
  //     @unlink('assets/front/img/gallery/' . $gallery->image);
  //     $filename = uniqid() . '.' . $extImage;
  //     @copy($image, 'assets/front/img/gallery/' . $filename);
  //     $gallery->image = $filename;
  //   }

  //   $gallery->save();

  //   Session::flash('success', 'Gallery updated successfully!');
  //   return "success";
  // }

  public function update(Request $request)
  {
      $event = Gallery::find($request->gallery_id);
      if(!empty($event))
      {
          $image = $request->image;
          $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
          $extImage = pathinfo($image, PATHINFO_EXTENSION);

          $rules = [
            'title' => 'required|max:255',
          'serial_number' => 'required|integer',
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
              $destinationPath = '/assets/stem/gallery/'; 
              if(!File::exists(public_path($destinationPath))) {
                File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
              }
              $image = $request->file('image');
              $imagename= $image->getClientOriginalName();

              //image resize logic
              $new_image = Image::make($image->getRealPath());
              if($new_image != null){
                  @unlink('assets/stem/gallery/' . $event->image);
                  $filename = uniqid() .'.'. $request->file('image')->extension();
                  $image_width= $new_image->width();
                  $image_height= $new_image->height();
                  $new_width= 720;
                  $new_height= 480;
                  $new_image->resize($new_width, $new_height);         
                  $new_image->save(public_path('assets/stem/gallery/' .$filename));
                  $event->image = $filename;
              }
          }
          
          $event->title = $request->title;
          $event->serial_number = $request->serial_number;
          $event->category_id = $request->category_id;
          $event->image = $filename; 
          
          $event->save();
      
          Session::flash('success', 'Gallery updated successfully!');
          
      }else{
          Session::flash('error', 'Gallery not found');
      }
      return "success";
  }

  public function delete(Request $request)
  {

    $gallery = Gallery::findOrFail($request->gallery_id);
    @unlink('assets/front/img/gallery/' . $gallery->image); 
    $gallery->delete();

    Session::flash('success', 'Image deleted successfully!');
    return back();
  }

  public function bulkDelete(Request $request)
  {
    $ids = $request->ids;

    foreach ($ids as $id) {
      $gallery = Gallery::findOrFail($id);
      @unlink('assets/front/img/gallery/' . $gallery->image);
      $gallery->delete();
    }

    Session::flash('success', 'Image deleted successfully!');
    return "success";
  }
}
