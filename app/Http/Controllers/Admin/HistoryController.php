<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtra;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\History;
use App\Exports\EventBookingExport;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

use Image;


class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {

        $lang = Language::where('code', $request->language)->first();
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();
        $lang_id = $lang->id;

         $data['history'] = History::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        // $data['event_categories'] = EventCategory::where('lang_id', $lang_id)->where('status', '1')->get();
        return view('admin.history.index',$data);
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
        'years' => 'required|max:255',
        'description' => 'required|max:800',
      ];
  
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }
      $history = new History;
      if ($request->has('file')) {
        $destinationPath = '/assets/stem/history/'; 
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
            $new_image->save( ('assets/stem/history/' .$filename));
            $history->image = $filename;
        }

    }
            $history->language_id = $request->language_id;
            $history->title = isset($request->title) ? $request->title : '';
            $history->years = $request->years;
            $history->description = $request->description;
            $history->status = $request->status;
            $history->save();
            Session::flash('success', 'History added successfully!');
            return "success";

    }

    public function edit($id ,Request $request){
        $data['history'] = History::findOrFail($id);
         return view('admin.history.edit',$data);
    }


    public function update(Request $request)
    {
      $history = History::find($request->history_id);
        if(!empty($history))
        {
            $image = $request->image;
            $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
            $extImage = pathinfo($image, PATHINFO_EXTENSION);
            $rules = [
              
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
                $destinationPath = '/assets/stem/history/'; 
                if(!File::exists(public_path($destinationPath))) {
                  File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
                }
                $image = $request->file('image');
                $imagename= $image->getClientOriginalName();
  
                //image resize logic
                $new_image = Image::make($image->getRealPath());
                if($new_image != null){
                    @unlink('assets/stem/history/' . $history->image);
                    $filename = uniqid() .'.'. $request->file('image')->extension();
                    $image_width= $new_image->width();
                    $image_height= $new_image->height();
                    $new_width= 720;
                    $new_height= 480;
                    $new_image->resize($new_width, $new_height);         
                    $new_image->save(public_path('assets/stem/history/' .$filename));
                    $history->image = $filename;
                }
            }
            
            $history->title = isset($request->title) ? $request->title : '';
            $history->years=$request->years;
            $history->description=$request->description;
            $history->status = $request->status;
            $history->save();
       
            Session::flash('success', 'History updated successfully!');
            
        }else{
            Session::flash('error', 'History not found');
        }
        return "success";
    }
}
