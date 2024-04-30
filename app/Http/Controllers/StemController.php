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
}
