<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LeadershipController extends Controller
{
    public function index(Request $request)
    {
        dd('hi');
      $language = Language::where('code', $request->language)->first();
      $language_id = $language->id;
  
      $lead_categories = LeadCategory::where('language_id', $language_id)
        ->orderBy('id', 'asc')
        ->paginate(10);
  
      return view('admin.leadership.leader_category.index', compact('lead_categories'));
    }

    public function indexLead(Request $request)
    {
         dd('leadership');
    }
}
