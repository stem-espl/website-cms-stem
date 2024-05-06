@extends('admin.layout')

@php
if(!empty(request()->input('language')))
  $selLang = \App\Models\Language::where('code', request()->input('language'))->first();
else
  $selLang = \App\Models\Language::where('is_default', 1)->first();
@endphp
@if(!empty($selLang) && $selLang->rtl == 1)
@section('styles')
<style>
    form:not(.modal-form) input,
    form:not(.modal-form) textarea,
    form:not(.modal-form) select,
    select[name='language'] {
        direction: rtl;
    }
    form:not(.modal-form) .note-editor.note-frame .note-editing-area .note-editable {
        direction: rtl;
        text-align: right;
    }
</style>
@endsection
@endif

@section('content')
  <div class="page-header">
    <h4 class="page-title">Tender Add</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.tenders.index')}}">Tenders</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="javascript:void(0)">Tender Add</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Tender Add</div>
                </div>
                <div class="col-lg-2">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == $selLang->code ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" action="{{route('admin.tenders.store')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Tender Category **</label>
                  <select class="form-control" name="tender_category">
                    <option value="">Select</option>
                    @foreach($tendersCat as $cat)
                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                    @endforeach
                  </select>
                  <p id="errtender_category" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Title in English **</label>
                  <input type="text" class="form-control" name="title" value="" placeholder="Enter title in english">
                  <p id="errtitle" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Title in Marathi **</label>
                  <input type="text" class="form-control" name="title_mr" value="" placeholder="Enter title in marathi">
                  <p id="errtitle_mr" class="em text-danger mb-0"></p>
                </div>

                <div class="form-group">
                  <label for="">Description in English **</label>
                  <textarea class="form-control" name="description" value="" placeholder="Enter description in english"></textarea>
                  <p id="errdescription" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Description in Marathi **</label>
                  <textarea class="form-control" name="description_mr" value="" placeholder="Enter description in marathi"></textarea>
                  <p id="errdescription_mr" class="em text-danger mb-0"></p>
                </div>

                <div class="form-group">
                  <label for="">Tender E-Link **</label>
                  <input type="text" class="form-control" name="tender_link" value="" placeholder="Enter Tender E-Link">
                  <p id="errtender_link" class="em text-danger mb-0"></p>
                </div>

                <div class="form-group">
                  <label for="">Status **</label>
                  <select class="form-control ltr" name="status">
                    <option value="" selected disabled>Select a status</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                  </select>
                  <p id="errstatus" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <div id="downloadFile" class="form-group">
                      <label for="">Tender Document **</label>
                      <br>
                      <input name="tender_doc" type="file" accept="application/pdf" >
                      <p class="mb-0 text-warning">Only PDF file is allowed. File size should be less than 2MB.</p>
                      <p id="errtender_doc" class="mb-0 text-danger em"></p>
                  </div>
                </div>

                <div class="form-group">
                  <label for="">Deadline</label>
                  <input type="date" name="deadline" class="form-control">
                  <p id="errdeadline" class="mb-0 text-danger em"></p>
                </div>
                
              </form>

            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
