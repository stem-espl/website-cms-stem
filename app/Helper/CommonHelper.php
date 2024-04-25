<?php
namespace App\Helper;
use App\Models\Project;
use App\Models\Language;
use App\Models\Datasets;
use App\Models\SubProject;

class CommonHelper
{

    static function dashesToCamelCase($string) 
    {
        if($string == 'description' ){
            return "Description";
        }

        if($string == 'user_id'){
           return Null;             
        }

        if($string == 'id'){
            return null;
        }

        $str = ucwords(str_replace("_"," ",$string));

        if (str_contains($str, ' Id')) {
            $str = str_replace(" Id"," ",$str);
        }
        return $str;
    }

    static function total_dataset_count($lang = null)
    {
        $dataset_cnt = 0;
        $datasetArr = [];
        $project = Project::select('id');
        // if(!empty($lang))
        // {
        //     $project = $project->where('language_id', $lang);
        // }
        $project = $project->where('status',1)->where('is_active',1)->get();

        foreach ($project as $key => $value) {
            if(!empty($lang))
            {
                $datasetArr[] = Datasets::where('project_id',$value->id)->where('active',1)->count();
            }else{
                $datasetArr[] = Datasets::where('project_id',$value->id)->count();
            }
        }

        $dataset_cnt = array_sum($datasetArr);
        return $dataset_cnt;
    }

    static function dataset_count($project_id = null, $type = null, $lang = null)
    {
        $dataset_cnt = 0;
        $datasetArr = [];
        $project = Project::select('id');
        if(!empty($project_id))
        {
            $project = $project->where('id', $project_id);
        }

        if($type == 'archive')
        {
            $project = $project->where('is_active',0);
        }
        elseif(!empty($project_id) && empty($type))
        {
            $project = $project->where('is_active','!=',0);
        }else{}

        $project = $project->get();

        foreach ($project as $key => $value) {
            if(!empty($lang))
            {
                $datasetArr[] = Datasets::where('project_id',$value->id)->where('active',1)->count();
            }else{
                $datasetArr[] = Datasets::where('project_id',$value->id)->count();
            }
        }

        $dataset_cnt = array_sum($datasetArr);
        return $dataset_cnt;
    }

    static function entityValue($key,$value) 
    {

        if($key == 'language_id'){
            $lang =  Language::where('id',$value)->first();
            if($lang){
                return $lang->name;
            }
            return $value;
        }

        if($key == 'project' || $key == 'project_id'){
            $lang =  Project::where('id',$value)->first();
            if($lang){
                return $lang->name;
            }
            return $value;
        }

        if($key == 'sub_project' || $key == 'sub_project_id'){
            $lang =  SubProject::where('id',$value)->first();
            if($lang){
                return $lang->name;
            }
            return $value;
        }

        if($key == 'file_data'){
            $valueArr = [];
            $value = json_decode($value);
            foreach ($value as $key => $value1) {
               $valueArr[] = $value1->filename;
            }
            $value = implode(',', $valueArr);
            return $value;
        }

        if($key == 'language_id'){

            if($value == 1){

                return "Yes";

            }else{
                return "No";
            }
        }
        return $value;
    }

    static function exportData($value){
        if(!empty($value->Surname)){
            return $value->Surname;
        }
        return $value;
    }

    static function comparision_data($oldValue, $newValue)
    {
       $val = strcmp($oldValue, $newValue);
       if($val !== 0)
       {
        return false;
       }
        return true;
    }
}