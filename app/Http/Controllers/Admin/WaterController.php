<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasicExtra;
use App\Models\WaterTeriff;
use App\Models\Language;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Image;

class WaterController extends Controller
{
    public function index(Request $request) {
        // dd('hi');
        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();

        $lang_id = $lang->id;
        $data['teriffs'] = WaterTeriff::orderBy('id', 'DESC')->get();
        // dd($data['profit']);
    
        $data['lang_id'] = $lang_id;
    
        $data['categoryInfo'] = BasicExtra::first();
        return view('admin.water.index',$data);
    }

    public function store(Request $request)
    {
 
      $rules = [
        'institution' => 'required|unique:water_teriff,institution,NULL,id,deleted_at,NULL',
        'amount' => 'required',
      ];
  
      $validator = Validator::make($request->all(), $rules);
  
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }
  
      $teriff = new WaterTeriff;
      $teriff->institution = $request->institution;
      $teriff->water_tariff = $request->amount;
      
      $teriff->save();
  
      Session::flash('success', 'Water Teriff Record added successfully!');
      return "success";
    }

    public function update(Request $request)
    {
        $teriff = WaterTeriff::find($request->teriff_id);
        if(!empty($teriff))
        {
            $rules = [
                
                'institution' => 'required|unique:water_teriff,institution,'.$request->teriff_id.',id,deleted_at,NULL',
                'amount' => 'required',
              ];
  
  
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errmsgs = $validator->getMessageBag()->add('error', 'true');
                return response()->json($validator->errors());
            }

            $teriff->institution = $request->institution;
            $teriff->water_tariff = $request->amount;
            
            $teriff->save();
        
            Session::flash('success', 'Water Teriff Record updated successfully!');
            // return redirect()->route('admin.profit.index');
            
        }else{
            Session::flash('error', 'Water Teriff Record not found');
        }
        return "success";
    }


    public function delete(Request $request)
    {
  
      $teriffModel = WaterTeriff::findOrFail($request->teriff_id);
      $teriffModel->delete();
  
      Session::flash('success', 'Water Teriff Record deleted successfully!');
      return back();
    }
 
 
}
