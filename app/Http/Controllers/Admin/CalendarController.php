<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\admin;
use App\Models\Language;
use Illuminate\Support\Facades\File;
use Validator;
use Session;
use Auth;
use Image;


class CalendarController extends Controller
{
    public function index(Request $request) {
        // $lang = Language::where('code', $request->language)->first();
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();
        $lang_id = $lang->id;
        $data['events'] = News::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        $data['lang_id'] = $lang_id;

        $user = Auth::user();
        $usename = $user->first_name;
        return view('admin.calendar.index', $data,compact('usename'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'datetimes' => 'required',
            'img' =>   'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $calendar = new News;
        if ($request->has('img')) {
            $destinationPath = '/assets/stem/news/'; 
            if(!File::exists(public_path($destinationPath))) {
              File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }
            $image = $request->file('img');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
                $filename = uniqid() .'.'. $request->file('img')->extension();
                $image_width= $new_image->width();
                $image_height= $new_image->height();
                $new_width= 720;
                $new_height= 480;
                $new_image->resize($new_width, $new_height);         
                $new_image->save(public_path('assets/stem/news/' .$filename));
                $calendar->image = $filename;
            }
        }
        
        $calendar->language_id = $request->language_id;
        $calendar->title = $request->title;
        $calendar->date = $request->datetimes;    
        $calendar->created_by = auth()->id(); 
        $calendar->save();
        Session::flash('success', 'Event added to calendar successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $event = News::find($request->id);
        if(!empty($event))
        {
            $image = $request->image;
            $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
            $extImage = pathinfo($image, PATHINFO_EXTENSION);

            $rules = [
                'title' => 'required|max:255',
                'date' => 'required',
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
                $destinationPath = '/assets/stem/news/'; 
                if(!File::exists(public_path($destinationPath))) {
                  File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
                }
                $image = $request->file('image');
                $imagename= $image->getClientOriginalName();

                //image resize logic
                $new_image = Image::make($image->getRealPath());
                if($new_image != null){
                    @unlink('assets/stem/news/' . $event->image);
                    $filename = uniqid() .'.'. $request->file('image')->extension();
                    $image_width= $new_image->width();
                    $image_height= $new_image->height();
                    $new_width= 720;
                    $new_height= 480;
                    $new_image->resize($new_width, $new_height);         
                    $new_image->save(public_path('assets/stem/news/' .$filename));
                    $event->image = $filename;
                }
            }
        
            $event->title = $request->title;
            $event->date = $request->date;
            $event->save();
        
            Session::flash('success', 'News updated successfully!');
            
        }else{
            Session::flash('error', 'News not found');
        }
        return "success";
    }
    
    

    public function delete(Request $request)
    {
        $calendar = News::find($request->event_id);
        $calendar->delete();

        Session::flash('success', 'Event deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $calendar = News::find($id);
            $calendar->delete();
        }

        Session::flash('success', 'Events deleted successfully!');
        return "success";
    }


    public function edit(Request $request,$id)
    {
        $lang = Language::where('code', $request->language)->first();
        $data['event'] = News::findOrFail($id);
       return view('admin.calendar.edit',$data);
    }


}
