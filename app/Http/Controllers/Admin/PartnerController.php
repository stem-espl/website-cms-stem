<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Language;
use Illuminate\Support\Facades\File;
use Validator, Image;
use Session;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['partners'] = Partner::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();

        $data['lang_id'] = $lang_id;
        return view('admin.home.partner.index', $data);
    }

    public function edit($id)
    {
        $data['partner'] = Partner::findOrFail($id);
        return view('admin.home.partner.edit', $data);
    }


    public function store(Request $request)
    {
        $image = $request->image;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extImage = pathinfo($image, PATHINFO_EXTENSION);

        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'image' => 'required',
            'title' => 'required|max:255',
            // 'url' => 'required|max:255',
            'serial_number' => 'required|integer',
        ];

        if ($request->filled('image')) {
            $rules['image'] = [
                function ($attribute, $value, $fail) use ($extImage, $allowedExts) {
                    if (!in_array($extImage, $allowedExts)) {
                        return $fail("Only png, jpg, jpeg, svg image is allowed");
                    }
                }
            ];
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $partner = new Partner;
        $count = Partner::where('language_id',$request->language_id)->get()->count();
        if($count < 4) {
            $partner->language_id = $request->language_id;
            $partner->title = $request->title;
            $partner->url = $request->url;
            $partner->serial_number = $request->serial_number;

            if ($request->has('image')) {
                $destinationPath = '/assets/stem/partners/'; 
                if(!File::exists(public_path($destinationPath))) {
                  File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
                }
                $image = $request->file('image');
                $imagename= $image->getClientOriginalName();

                //image resize logic
                $new_image = Image::make($image->getRealPath());
                if($new_image != null){
                    $filename = uniqid() .'.'. $request->file('image')->extension();
                    $image_width= $new_image->width();
                    $image_height= $new_image->height();
                    $new_width= 900;
                    $new_height= 900;
                    $new_image->resize($new_width, $new_height);         
                    $new_image->save(public_path('assets/stem/partners/' .$filename));
                    $partner->image = $filename;
                }
            }

            $partner->save();
        }
        else
        {
            Session::flash('error', 'You cant Add more than Four Records!');
            return "error";
        }
        Session::flash('success', 'Title added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $image = $request->image;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extImage = pathinfo($image, PATHINFO_EXTENSION);

        $rules = [
            'title' => 'required|max:255',
            // 'url' => 'required|max:255',
            'serial_number' => 'required|integer',
        ];

        if ($request->filled('image')) {
            $rules['image'] = [
                function ($attribute, $value, $fail) use ($extImage, $allowedExts) {
                    if (!in_array($extImage, $allowedExts)) {
                        return $fail("Only png, jpg, jpeg, svg image is allowed");
                    }
                }
            ];
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $partner = Partner::findOrFail($request->partner_id);
        $partner->title = $request->title;
        $partner->url = $request->url;
        $partner->serial_number = $request->serial_number;

        if ($request->has('image')) {
            $destinationPath = '/assets/stem/partners/'; 
            if(!File::exists(public_path($destinationPath))) {
              File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }
            $image = $request->file('image');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
                @unlink('assets/stem/partners/' . $partner->image);
                $filename = uniqid() .'.'. $request->file('image')->extension();
                $image_width= $new_image->width();
                $image_height= $new_image->height();
                $new_width= 900;
                $new_height= 900;
                $new_image->resize($new_width, $new_height);         
                $new_image->save(public_path('assets/stem/partners/' .$filename));
                $partner->image = $filename;
            }
        }

        $partner->save();

        Session::flash('success', 'Partner updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {

        $partner = Partner::findOrFail($request->partner_id);
        @unlink('assets/stem/partners/' . $partner->image);
        $partner->delete();

        Session::flash('success', 'Partner deleted successfully!');
        return back();
    }
}
