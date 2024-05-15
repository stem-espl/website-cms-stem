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

        // $lang = Language::where('code', $request->language)->first();
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();

        $lang_id = $lang->id;
        $data['egovernance'] = EGovernanceModel::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        // dd($data['egovernance']);
    
        $data['lang_id'] = $lang_id;
    
        $data['categoryInfo'] = BasicExtra::first();
        return view('admin.egovernance.egovernance',$data);
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
      $egovernance->url = $request->url;
      $egovernance->save();
  
      Session::flash('success', 'E-Governance added successfully!');
      return "success";
    }


    public function edit(Request $request, $id)
    {
      $lang = Language::where('code', $request->language)->first();
  
      $data['egovernan'] = EGovernanceModel::findOrFail($id);
  
      $data['categoryInfo'] = BasicExtra::first();
  
      return view('admin.egovernance.edit', $data);
    }

    public function update(Request $request)
    {
        $event = EGovernanceModel::find($request->egovernan_id);
        if(!empty($event))
        {
            $image = $request->image;
            $allowedExts = array('jpg', 'png', 'jpeg', 'svg');
            $extImage = pathinfo($image, PATHINFO_EXTENSION);
  
            $rules = [
            //   'title' => 'required|max:255',
            ];
  
            if ($request->has('image')) {
                $rules['image'] = [
                    'mimes:jpeg,jpg,png,svg',
                ];
            }
  
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errmsgs = $validator->getMessageBag()->add('error', 'true');
                return response()->json($validator->errors());
            }
  
            if ($request->has('image')) {
                $destinationPath = '/assets/stem/egovernance/'; 
                if(!File::exists(public_path($destinationPath))) {
                  File::makeDirectory(public_path($destinationPath), $mode = 0777, true, true);
                }
                $image = $request->file('image');
                $imagename= $image->getClientOriginalName();
  
                //image resize logic
                $new_image = Image::make($image->getRealPath());
                if($new_image != null){
                    @unlink('assets/stem/egovernance/' . $event->image);
                    $filename = uniqid() .'.'. $request->file('image')->extension();
                    $image_width= $new_image->width();
                    $image_height= $new_image->height();
                    $new_width= 769;
                    $new_height= 445;
                    $new_image->resize($new_width, $new_height);         
                    $new_image->save(public_path('assets/stem/egovernance/' .$filename));
                    $event->image = $filename;
                }
            }
            $event->title = $request->title;
            $event->status = $request->status;
            $event->url = $request->url;
            $event->save();
        
            Session::flash('success', 'E-Governance updated successfully!');
            // return redirect()->route('admin.egovernance.index');
            
        }else{
            Session::flash('error', 'E-Governance not found');
        }
        return "success";
    }


    public function delete(Request $request)
    {
  
      $egovernanceModel = EGovernanceModel::findOrFail($request->egovernance_id);
      @unlink('aassets/stem/egovernance/' . $egovernan->image); 
      $egovernanceModel->delete();
  
      Session::flash('success', 'E-Governance deleted successfully!');
      return back();
    }
  
}

