<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicExtended;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Language;
use Validator;
use Session;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['sliders'] = Slider::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();

        $data['lang_id'] = $lang_id;
        return view('admin.home.hero.slider.index', $data);
    }

    public function edit($id)
    {
        $data['slider'] = Slider::findOrFail($id);
        return view('admin.home.hero.slider.edit', $data);
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
            'title' => 'nullable',
            // 'title_font_size' => 'required|integer|digits_between:1,3',
            // 'text' => 'nullable',
            // 'text_font_size' => 'required|integer|digits_between:1,3',
            // 'button_text' => 'nullable',
            // 'button_text_font_size' => 'required|integer|digits_between:1,3',
            // 'button_url' => 'nullable|max:255',
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

        $be = BasicExtended::first();
        $version = $be->theme_version;

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $slider = new Slider;
        $slider->language_id = $request->language_id;
        $slider->title = $request->title;
      

        if ($request->filled('image')) {
            $filename = uniqid() .'.'. $extImage;
            @copy($image, 'assets/front/img/sliders/stem/' . $filename);
            $slider->image = $filename;
        }

        $slider->serial_number = $request->serial_number;
        $slider->save();

        Session::flash('success', 'Slider added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $image = $request->image;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extImage = pathinfo($image, PATHINFO_EXTENSION);

        $rules = [
            'title' => 'nullable',
            // 'title_font_size' => 'required|integer|digits_between:1,3',
            // 'text' => 'nullable',
            // 'text_font_size' => 'required|integer|digits_between:1,3',
            // 'button_text' => 'nullable',
            // 'button_text_font_size' => 'required|integer|digits_between:1,3',
            // 'button_url' => 'nullable|max:255',
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

        $be = BasicExtended::first();
        $version = $be->theme_version;

   
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $slider = Slider::findOrFail($request->slider_id);
        $slider->title = $request->title;
      
        if ($request->filled('image')) {
            @unlink('assets/front/img/sliders/stem/' . $slider->image);
            $filename = uniqid() .'.'. $extImage;
            @copy($image, 'assets/front/img/sliders/stem/' . $filename);
            $slider->image = $filename;
        }

        $slider->serial_number = $request->serial_number;
        $slider->save();

        Session::flash('success', 'Slider updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {

        $slider = Slider::findOrFail($request->slider_id);
        @unlink('assets/front/img/sliders/stem/' . $slider->image);
        $slider->delete();

        Session::flash('success', 'Slider deleted successfully!');
        return back();
    }
}
