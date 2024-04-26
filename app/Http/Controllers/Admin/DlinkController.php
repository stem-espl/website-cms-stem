<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Dlink;
use Validator;
use Session;

class DlinkController extends Controller
{
    public function index(Request $request)
    {
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();
        $lang_id = $lang->id;
        $data['dlink'] = Dlink::where('language_id', $lang_id)->get();
        $data['lang_id'] = $lang_id;
        return view('admin.footer.dlink.index', $data);
    }

    public function edit($id)
    {
        $data['dlink'] = Dlink::find($id);
        return view('admin.footer.dlink.edit', $data);
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

        $dlink = new Dlink;
        $dlink->language_id = $request->language_id;
        $dlink->name = $request->name;
        $dlink->url = $request->url;
        $dlink->save();

        Session::flash('success', 'Department link added successfully!');
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
        $dlink = Dlink::find($request->dlink_id);
        $dlink->name = $request->name;
        $dlink->url = $request->url;
        $dlink->save();

        Session::flash('success', 'Department link updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {

        $dlink = Dlink::find($request->dlink_id);
        $dlink->delete();

        Session::flash('success', 'Department deleted successfully!');
        return back();
    }
}
