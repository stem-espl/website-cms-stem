<?php

namespace App\Http\Controllers\Admin;
use App\Models\BasicExtra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EGovernanceModel;
use App\Models\Language;
use Validator;
use Session;
use Illuminate\Support\Facades\File;
use Image;

class EGovernanceController extends Controller
{
    public function index(Request $request) {

        $lang = Language::where('code', $request->language)->first();

        $lang_id = $lang->id;
        $data['galleries'] = EGovernanceModel::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
    
        $data['lang_id'] = $lang_id;
    
        $data['categoryInfo'] = BasicExtra::first();
        return view('admin.egovernance.egovernance');
    }

    public function store(Request $request)
    {
  
      $image = $request->file;
      $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
      $messages = [
        'language_id.required' => 'The language field is required',
        'file.required' => 'The Image field is required',
      ];
  
      $rules = [
        'language_id' => 'required',
        'file' => 'required',
        'title' => 'required|max:255',
      ];
  
      $validator = Validator::make($request->all(), $rules, $messages);
  
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }
  
      $egovernance = new EGovernanceModel;
  
      if ($request->has('file')) {
        $destinationPath = '/assets/stem/egovernance/'; 
        if(!File::exists(public_path($destinationPath))) {
          File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
        }
        $image = $request->file('file');
        $imagename= $image->getClientOriginalName();
  
        //image resize logic
        $new_image = Image::make($image->getRealPath());
        if($new_image != null){
            $filename = uniqid() .'.'. $request->file('file')->extension();
            $image_width= $new_image->width();
            $image_height= $new_image->height();
            $new_width= 720;
            $new_height= 480;
            $new_image->resize($new_width, $new_height);         
            $new_image->save( ('assets/stem/egovernance/' .$filename));
            $egovernance->image = $filename;
        }
    }
  
      $egovernance->language_id = $request->language_id;
      $egovernance->title = $request->title;
  
      $egovernance->save();
  
      Session::flash('success', 'E-Governance added successfully!');
      return "success";
    }
  
}

