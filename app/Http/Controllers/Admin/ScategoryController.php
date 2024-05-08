<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Scategory;
use App\Models\Language;
use App\Models\Megamenu;
use Validator, Image;
use Session;

class ScategoryController extends Controller
{
    public function index(Request $request)
    {
        // $lang = Language::where('code', $request->language)->first();
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();

        $lang_id = $lang->id;
        $data['scategorys'] = Scategory::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;
        return view('admin.service.scategory.index', $data);
    }

    public function edit($id)
    {
        $data['scategory'] = Scategory::findOrFail($id);
        return view('admin.service.scategory.edit', $data);
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
            'image' => 'nullable',
            'name' => 'required|max:255',
            'short_text' => 'required',
            'status' => 'required',
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

        $scategory = new Scategory;
        $count = Scategory::where('language_id', $request->language_id)->get()->count();
        if($count < 4) {
            $scategory->language_id = $request->language_id;
            $scategory->name = $request->name;
            $scategory->status = $request->status;
            $scategory->short_text = $request->short_text;
            $scategory->serial_number = $request->serial_number;

            if ($request->has('image')) {

            $destinationPath = '/assets/stem/service_category/'; 
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
                    $new_width= 1191;
                    $new_height= 1600;
                    $new_image->resize($new_width, $new_height);         
                    $new_image->save(public_path('assets/stem/service_category/' .$filename));
                    $scategory->image = $filename;
                }
            }


            $scategory->save();
        }
        else
        {
            Session::flash('error', 'You cant Add more than Four Records!');
            return "success";
        }
        Session::flash('success', 'Category added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $image = $request->image;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extImage = pathinfo($image, PATHINFO_EXTENSION);

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required',
            'short_text' => 'required',
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

        $scategory = Scategory::findOrFail($request->scategory_id);
        $scategory->name = $request->name;
        $scategory->status = $request->status;
        $scategory->short_text = $request->short_text;
        $scategory->serial_number = $request->serial_number;

        if ($request->has('image')) {
            $destinationPath = '/assets/stem/service_category/'; 
            if(!File::exists(public_path($destinationPath))) {
              File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }

            $image = $request->file('image');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
                @unlink('assets/stem/service_category/' . $scategory->image);
                $filename = uniqid() .'.'. $request->file('image')->extension();
                $image_width= $new_image->width();
                $image_height= $new_image->height();
                $new_width= 1191;
                $new_height= 1600;
                $new_image->resize($new_width, $new_height);         
                $new_image->save(public_path('assets/stem/service_category/' .$filename));
                $scategory->image = $filename;
            }
        }

        $scategory->save();

        Session::flash('success', 'Category updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {
        $scategory = Scategory::findOrFail($request->scategory_id);

        if ($scategory->services()->count() > 0) {
            Session::flash('warning', 'First, delete all the services under this category!');
            return back();
        }
        @unlink('assets/stem/service_category/' . $scategory->image);

        $this->deleteFromMegaMenu($scategory);

        $scategory->delete();

        Session::flash('success', 'Scategory deleted successfully!');
        return back();
    }

    public function deleteFromMegaMenu($scategory) {
        $megamenu = Megamenu::where('language_id', $scategory->language_id)->where('category', 1)->where('type', 'services');
        if ($megamenu->count() > 0) {
            $megamenu = $megamenu->first();
            $menus = json_decode($megamenu->menus, true);
            $catId = $scategory->id;
            if (is_array($menus) && array_key_exists("$catId", $menus)) {
                unset($menus["$catId"]);
                $megamenu->menus = json_encode($menus);
                $megamenu->save();
            }
        }
        $megamenu = Megamenu::where('language_id', $scategory->language_id)->where('category', 1)->where('type', 'portfolios');
        if ($megamenu->count() > 0) {
            $megamenu = $megamenu->first();
            $menus = json_decode($megamenu->menus, true);
            $catId = $scategory->id;
            if (is_array($menus) && array_key_exists("$catId", $menus)) {
                unset($menus["$catId"]);
                $megamenu->menus = json_encode($menus);
                $megamenu->save();
            }
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $scategory = Scategory::findOrFail($id);
            if ($scategory->services()->count() > 0) {
                Session::flash('warning', 'First, delete all the services under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $scategory = Scategory::findOrFail($id);
            @unlink('assets/stem/service_category/' . $scategory->image);

            $this->deleteFromMegaMenu($scategory);

            $scategory->delete();
        }

        Session::flash('success', 'Service categories deleted successfully!');
        return "success";
    }

    public function feature(Request $request)
    {
        $scategory = Scategory::find($request->scategory_id);
        $scategory->feature = $request->feature;
        $scategory->save();

        if ($request->feature == 1) {
            Session::flash('success', 'Featured successfully!');
        } else {
            Session::flash('success', 'Unfeatured successfully!');
        }

        return back();
    }
}
