<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtended;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BasicSetting as BS;
use Illuminate\Support\Facades\File;
use App\Models\Language;
use Session;
use Validator, Image;

class IntrosectionController extends Controller
{
    public function index(Request $request)
    {
        // $lang = Language::where('code', $request->language)->firstOrFail();
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        $data['abe'] = $lang->basic_extended;

        return view('admin.home.intro-section', $data);
    }

    public function update(Request $request, $langid)
    {

        $image = $request->image;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extImage = pathinfo($image, PATHINFO_EXTENSION);

        $image2 = $request->image_2;
        $extImage2 = pathinfo($image2, PATHINFO_EXTENSION);

        $rules = [
            'intro_section_title' => 'required|max:70',
            'intro_section_subtitle' => 'required|max:80',
            'intro_section_text' => 'required|min:100',
            'intro_section_button_text' => 'nullable|max:400',
            'intro_section_button_url' => 'nullable|max:255',
            // 'intro_section_video_link' => 'nullable'
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

        if ($request->filled('image_2')) {
            $rules['image_2'] = [
                function ($attribute, $value, $fail) use ($extImage2, $allowedExts) {
                    if (!in_array($extImage2, $allowedExts)) {
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

        $bs = BS::where('language_id', $langid)->firstOrFail();
        $bs->intro_section_title = $request->intro_section_title;
        $bs->intro_section_subtitle = $request->intro_section_subtitle;
        $bs->intro_section_text = $request->intro_section_text;
        $bs->intro_section_button_text = $request->intro_section_button_text;
        $bs->intro_section_button_url = $request->intro_section_button_url;
        $videoLink = isset($request->intro_section_video_link) ? $request->intro_section_video_link : '';
        if (strpos($videoLink, "&") != false) {
            $videoLink = substr($videoLink, 0, strpos($videoLink, "&"));
        }
        // $bs->intro_section_video_link = $videoLink;

        if ($request->has('image')) {
            $destinationPath = '/assets/stem/intro/'; 
            if(!File::exists(public_path($destinationPath))) {
              File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }

            $image = $request->file('image');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
                @unlink('assets/stem/intro/' . $bs->intro_bg);
                $filename = uniqid() .'.'. $request->file('image')->extension();
                $image_width= $new_image->width();
                $image_height= $new_image->height();
                $new_width= 575;
                $new_height= 645;
                $new_image->resize($new_width, $new_height);         
                $new_image->save(public_path('assets/stem/intro/' .$filename));
                $bs->intro_bg = $filename;
            }
        }

        $bs->save();

        $be = BasicExtended::where('language_id', $langid)->firstOrFail();

        if ($request->has('image_2')) {
            $destinationPath = '/assets/stem/intro/'; 
            if(!File::exists(public_path($destinationPath))) {
              File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }

            $image = $request->file('image_2');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
                @unlink('assets/stem/intro/' . $be->intro_bg2);
                $filename = uniqid() .'.'. $request->file('image_2')->extension();
                $image_width= $new_image->width();
                $image_height= $new_image->height();
                $new_width= 575;
                $new_height= 645;
                $new_image->resize($new_width, $new_height);         
                $new_image->save(public_path('assets/stem/intro/' .$filename));
                $be->intro_bg2 = $filename;
            }
        }
        $be->save();

        Session::flash('success', 'Informations updated successfully!');
        return "success";
    }
}
