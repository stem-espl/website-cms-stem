<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Alink;
use Validator;
use Session;

class AlinkController extends Controller
{
    public function index(Request $request)
    {
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();
        $lang_id = $lang->id;
        $data['alink'] = Alink::where('language_id', $lang_id)->get();
        $data['lang_id'] = $lang_id;
        return view('admin.footer.alink.index',$data);
    }

    public function edit($id)
    {
        $data['alink'] = Alink::find($id);
        return view('admin.footer.alink.edit', $data);
    }

    public function store(Request $request)
    {

        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'name' => 'required|max:255',
            'url' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $alink = new Alink;
        $alink->language_id = $request->language_id;
        $alink->name = $request->name;
        $alink->url = $request->url;
        $alink->save();

        Session::flash('success', 'About link added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'url' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $alink = Alink::find($request->alink_id);
        $alink->name = $request->name;
        $alink->url = $request->url;
        $alink->save();

        Session::flash('success', 'About link updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {
        $alink = Alink::find($request->ulink_id);
        $alink->delete();

        Session::flash('success', 'About deleted successfully!');
        return back();
    }
}
