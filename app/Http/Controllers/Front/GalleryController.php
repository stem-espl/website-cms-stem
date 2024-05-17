<?php

namespace App\Http\Controllers\Front;

use App\Models\BasicExtra;
use App\Models\GalleryCategory;
use App\Models\Gallery;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class GalleryController extends Controller
{

  public function index($slug){
    
    if (session()->has('lang')) {
        $currentLang = Language::where('code', session()->get('lang'))->first();
    } else {
        $currentLang = Language::where('is_default', 1)->first();
    }  
    
    $lang_code = isset($currentLang->code) ? $currentLang->code : 'en';
      if($lang_code == 'mr')
    {
        $category = GalleryCategory::select('id','gallery_categories.name_mr as name')->where('slug', $slug)->firstOrFail();
        $name = $category->name;
    }else{
        $category = GalleryCategory::select('id','gallery_categories.name as name')->where('slug', $slug)->firstOrFail();
        $name = $category->name;
    }
      $gallery = Gallery::where('category_id', $category->id)->get();
     
      return view('front.gallery.gallery',compact('gallery','name'));
  }

}
