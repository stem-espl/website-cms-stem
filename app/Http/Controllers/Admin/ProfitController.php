<?php

namespace App\Http\Controllers\Admin;
use App\Models\BasicExtra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfitChart;
use App\Models\Language;
use Validator;
use Session;
use Illuminate\Support\Facades\File;
use Image;

class ProfitController extends Controller
{
    public function index(Request $request) {

        $lang_code = isset($request->language) ?  $request->language : 'en';
        $lang = Language::where('code', $lang_code)->first();

        $lang_id = $lang->id;
        $data['profits'] = ProfitChart::orderBy('id', 'DESC')->get();
        // dd($data['profit']);
    
        $data['lang_id'] = $lang_id;
    
        $data['categoryInfo'] = BasicExtra::first();
        return view('admin.profit.index',$data);
    }

    public function store(Request $request)
    {
  
      $rules = [
        'year' => 'required|unique:profit_chart,label,NULL,id,deleted_at,NULL',
        'amount' => 'required',
      ];
  
      $validator = Validator::make($request->all(), $rules);
  
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }
  
      $profit = new ProfitChart;
      $profit->label = $request->year;
      $profit->amount = $request->amount;
      $profit->save();
  
      Session::flash('success', 'Profit added successfully!');
      return "success";
    }

    public function update(Request $request)
    {
        $profit = ProfitChart::find($request->profit_id);
        if(!empty($profit))
        {
            $rules = [
                'year' => 'required|unique:profit_chart,label,'.$request->profit_id.',id,deleted_at,NULL',
                'amount' => 'required',
              ];
  
  
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errmsgs = $validator->getMessageBag()->add('error', 'true');
                return response()->json($validator->errors());
            }

            $profit->label = $request->year;
            $profit->amount = $request->amount;
            $profit->save();
        
            Session::flash('success', 'Profit updated successfully!');
            // return redirect()->route('admin.profit.index');
            
        }else{
            Session::flash('error', 'Profit not found');
        }
        return "success";
    }


    public function delete(Request $request)
    {
  
      $profitModel = ProfitChart::findOrFail($request->profit_id);
      $profitModel->delete();
  
      Session::flash('success', 'Profit deleted successfully!');
      return back();
    }
  
}

