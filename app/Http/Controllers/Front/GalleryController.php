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

    $category = GalleryCategory::where('slug', $slug)->firstOrFail();
    $gallery = Gallery::where('category_id', $category->id)->get();
    $name=$category->name;
    return view('front.gallery.gallery',compact('gallery','name'));
  }

}
