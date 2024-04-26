<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Language;
use Validator;
use Session;

class CalendarController extends Controller
{
    public function index(Request $request) {
        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['events'] = News::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();

        $data['lang_id'] = $lang_id;

        return view('admin.calendar.index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $calendar = new News;
        $calendar->language_id = $request->language_id;
        $calendar->title = $request->title;
        $calendar->date = $request->date;
        

        $calendar->save();

        Session::flash('success', 'Event added to calendar successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $messages = [
            'date.required' => 'Event period is required',
            'end_date.required' => 'Event period is required',
        ];

        $rules = [
            'title' => 'required|max:255',
            'date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $calendar = News::find($request->event_id);
        $calendar->title = $request->title;
        $calendar->date = $request->date;
        
        $calendar->save();

        Session::flash('success', 'Event date updated in calendar successfully!');
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
}
