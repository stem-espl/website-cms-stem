<?php

namespace App\Http\Controllers;
use App\Models\Audit;
use App\Models\BasicSetting;
use App\Models\admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\CommonHelper;
use Auth;
class AuditReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Audit::get();
            foreach($data as $row)
            {
                if($row->auditable_type == 'App\Models\BasicSetting'){
                    $modalName = "BasicSetting";    
                    
                    $userId = null;
                    if (Auth::check()) {
                        $userId = Auth::id();
                    }
                
                 $row->user_id = $userId;
                 $userName = Admin::where('id', $row->user_id)->select('first_name','last_name')->first();
                }             
    
                $row->user_id = $userName->first_name.'  '.$userName->last_name ; 
                $row->event = $modalName . " " .$row->event;
                $row->new_values= json_decode($row->new_values);
                $row->old_values= json_decode($row->old_values); 
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return date('d-m-Y h:i:s', strtotime($data->created_at) );
                })
                ->addColumn('action', function($row){
                    $actionBtn = '';                   
                    $actionBtn = '<a class="btn btn-primary" href="show-report/'.$row->id.'" ><i class="fa fa-eye " ></i></a>';                    
                    return $actionBtn;
                })  
                ->addColumn('new_values', function($row){
                $options = '';
                $i=0;
                if (is_array($row->new_values) || is_object($row->new_values))
                {
                    foreach ($row->new_values as $key => $val) {
                        if(isset($val)){
                            $label = CommonHelper::dashesToCamelCase($key);
                            $result = CommonHelper::entityValue($key,$val);
                            if(isset($label) && isset($result) ){
                                $options .='<p ><b style="font-size:12px">'.$label.':</b>';
                                if($label == 'Content')
                                {
                                    $value = isset($result) ? json_decode($result) : [];
                                    if((is_array($value)) && (count($value) > 0)){
                                        foreach ($value as $key2 => $value2) {
                                           $options .='<p> Text: '.$value2->text.'</p><br/><p>Description: '.$value2->description.'</p><br/>';
                                        }
                                    }
                                }else{
                                    $options .='<p ><b style="font-size:12px">'.$label.':</b>'. $result.'</p>'; 
                                }
                            }
                        }
                    }
                }
                return $options;
            })
            ->addColumn('old_values', function($row){
                $oldValues = '';
                $i=0;
                if (is_array($row->old_values) || is_object($row->old_values))
                {
                    foreach ($row->old_values as $ke => $value) {
                        if(isset($value)){
                            $label = CommonHelper::dashesToCamelCase($ke);
                            $result = CommonHelper::entityValue($ke,$value);
                            $oldValues .='<p ><b style="font-size:12px">'.$label.':</b>';
                            if($label == 'Content')
                            {
                                $value = isset($result) ? json_decode($result) : [];
                                if((is_array($value)) && (count($value) > 0)){
                                    foreach ($value as $key2 => $value2) {
                                       $oldValues .='<p> Text: '.$value2->text.'</p><br/><p>Description: '.$value2->description.'</p><br/>';
                                    }
                                }
                            }else{
                                $oldValues .='<p><b>'.$label.':</b>'. $result.'</p>'; 
                            }
                        }
                    }
                }
                return $oldValues;
            })
            ->rawColumns(['action','new_values','old_values'])
            ->make(true);
        }
        return view('admin.auditReport.index');
    }

}
