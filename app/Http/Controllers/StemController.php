<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class StemController extends Controller
{

        public function index(){
        $data=News::all();
        return view('admin.calendar.news',compact('data'));
       }

       public function aboutus()
       {
         return view('front.stem.about');
       }

       public function profitReport()
       {
         return view('front.stem.profit');
       }
}
