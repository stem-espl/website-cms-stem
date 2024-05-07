<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BasicSetting as BS;
use App\Models\Language;
use Validator;
use Session;

class ServicesectionController extends Controller
{
    public function index(Request $request)
    {
        // $lang = Language::where('code', $request->language)->firstOrFail();
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;

        return view('admin.home.service-section', $data);
    }

    public function update(Request $request, $langid)
    {
        $rules = [
            // 'service_section_subtitle' => 'required|max:80',
            'our_services_desc' => 'required|max:400|min:200',
            'service_section_title' => 'required|max:25'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $bs = BS::where('language_id', $langid)->firstOrFail();
        // $bs->service_section_subtitle = $request->service_section_subtitle;
        $bs->our_services_desc = $request->our_services_desc;
        $bs->service_section_title = $request->service_section_title;
        $bs->save();

        Session::flash('success', 'Texts updated successfully!');
        return "success";
    }
}
