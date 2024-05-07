<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BasicSetting as BS;
use Illuminate\Support\Facades\File;
use App\Models\Language;
use Validator;
use Session;
use Image;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;

        return view('admin.footer.logo-text', $data);
    }


    public function update(Request $request, $langid)
    {
        $footerLogo = $request->footer_logo;
        $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
        $extFooterLogo = pathinfo($footerLogo, PATHINFO_EXTENSION);

        $rules = [
            'footer_text' => 'required',
            'newsletter_text' => 'required|max:255',
            'copyright_text' => 'required',
        ];

        if ($request->filled('footer_logo')) {
            $rules['footer_logo'] = [
                function ($attribute, $value, $fail) use ($extFooterLogo, $allowedExts) {
                    if (!in_array($extFooterLogo, $allowedExts)) {
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
        $bs->footer_text = $request->footer_text;
        $bs->newsletter_text = $request->newsletter_text;
        $bs->copyright_text = str_replace(url('/') . '/assets/front/img/', "{base_url}/assets/front/img/", $request->copyright_text);

        if ($request->has('image')) {
            $destinationPath = '/assets/stem/footer/'; 
            if(!File::exists(public_path($destinationPath))) {
                File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
            }
            $image = $request->file('image');
            $imagename= $image->getClientOriginalName();

            //image resize logic
            $new_image = Image::make($image->getRealPath());
            if($new_image != null){
              @unlink('assets/stem/footer/' . $bs->footer_logo);
              $filename = uniqid() .'.'. $request->file('image')->extension();
              $image_width= $new_image->width();
              $image_height= $new_image->height();
              $new_width= 196;
              $new_height= 68;
              $new_image->resize($new_width, $new_height);         
              $new_image->save(public_path('assets/stem/footer/' .$filename));
              $bs->footer_logo = $filename;
            }
        }

        $bs->save();

        Session::flash('success', 'Footer text updated successfully!');
        return "success";
    }
}
