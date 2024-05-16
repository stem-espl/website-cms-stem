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
  <h4 class="page-title">E-Governance Images</h4>
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
      <a href="javascript:void(0)">e-Governance</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-4">
            <div class="card-title d-inline-block">e-Governance Images</div>
          </div>
          <div class="col-lg-3">
                  @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == $selLang->code ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
          </div>
          <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
            <a href="javascript:void(0)" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i
                class="fas fa-plus"></i> Add Image</a>
            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
              data-href="{{route('admin.gallery.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            @if (count($egovernance) == 0)
            <h3 class="text-center">NO IMAGE FOUND</h3>
            @else
            <div class="table-responsive">
              <table class="table table-striped mt-3" id="basic-datatables">
                <thead>
                  <tr>
                    <th scope="col">
                      <input type="checkbox" class="bulk-check" data-val="all">
                    </th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">URL</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($egovernance as $key => $egovernanc)
                  <tr>
                    <td>
                      <input type="checkbox" class="bulk-check" data-val="{{$egovernanc->id}}">
                    </td>
                    <td><img src="{{asset('assets/stem/egovernance/'.$egovernanc->image)}}" alt="" width="80"></td>
                    <td>
                      {{strlen($egovernanc->title) > 70 ? mb_substr($egovernanc->title, 0, 70, 'UTF-8') . '...' : $egovernanc->title}}
                    </td>
                      @if(!empty($egovernanc->url))
                          <td>{{$egovernanc->url}}</td>
                      @else
                          <td>NA</td>
                      @endif
                    <td>
                      @if ($egovernanc->status == 1)
                      <h2 class="d-inline-block"><span class="badge badge-success">Active</span></h2>
                      @else
                      <h2 class="d-inline-block"><span class="badge badge-danger">Deactive</span></h2>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-secondary btn-sm"
                        href="{{route('admin.egovernance.edit', $egovernanc->id) . '?language=' . request()->input('language')}}">
                        <span class="btn-label">
                          <i class="fas fa-edit"></i>
                        </span>
                        Edit
                      </a>
                      <form class="deleteform d-inline-block" action="{{route('admin.egovernance.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="egovernance_id" value="{{$egovernanc->id}}">
                        <button type="submit" class="btn btn-danger btn-sm deletebtn">
                          <span class="btn-label">
                            <i class="fas fa-trash"></i>
                          </span>
                          Delete
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Create Gallery Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">E-Governance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ajaxForm" class="modal-form" action="{{route('admin.egovernance.store')}}" method="POST">
          @csrf
          {{-- Image Part --}}
          <div class="form-group">
            <label for="">Image ** </label>
            <input class="form-control" type="file" id="file" name="file">
            <p id="errfile" class="mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">Language **</label>
            <select name="language_id" class="form-control">
              <option value="" selected disabled>Select a language</option>
              @foreach ($langs as $lang)
              <option value="{{$lang->id}}">{{$lang->name}}</option>
              @endforeach
            </select>
            <p id="errlanguage_id" class="mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">Title **</label>
            <input type="text" class="form-control" name="title" placeholder="Enter title" value="">
            <p id="errtitle" class="mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">URL**</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="Enter url" value="">
            <p id="errurl" class="mb-0 text-danger em"></p>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- Image LFM Modal -->
<div class="modal fade lfm-modal" id="lfmModal1" tabindex="-1" role="dialog" aria-labelledby="lfmModalTitle"
  aria-hidden="true">
  <i class="fas fa-times-circle"></i>
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <iframe src="{{url('laravel-filemanager')}}?serial=1"
          style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
      </div>
    </div>
  </div>
</div>
@endsection
