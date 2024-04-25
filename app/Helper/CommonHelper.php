<?php
namespace App\Helper;
use App\Models\Language;


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