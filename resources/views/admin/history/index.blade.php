@extends('admin.layout')

@php
$selLang = \App\Models\Language::where('code', request()->input('language'))->first();
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
  <h4 class="page-title">History</h4>
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
      <a href="#">History Management</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-4">
            <div class="card-title d-inline-block">History</div>
          </div>
          <div class="col-lg-3">
            @if (!empty($langs))
            <select name="language" class="form-control"
              onchange="window.location='{{url()->current() . '?language='}}'+this.value">
              <option value="" selected disabled>Select a Language</option>
              @foreach ($langs as $lang)
              <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>
                {{$lang->name}}</option>
              @endforeach
            </select>
            @endif
          </div>
          <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
            <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i
                class="fas fa-plus"></i> Add History    </a>
            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
              data-href="{{route('admin.gallery.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            @if (count($history) == 0)
            <h3 class="text-center">NO History FOUND</h3>
            @else
            <div class="table-responsive">
              <table class="table table-striped mt-3" id="basic-datatables">
                <thead>
                  <tr>
                    <th scope="col">
                      <input type="checkbox" class="bulk-check" data-val="all">
                    </th>
                    <th scope="col">Image</th>
                    <th scope="col">Years</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($history as $key => $historyData)
                  <tr>
                    <td>
                      <input type="checkbox" class="bulk-check" data-val="{{$historyData->id}}">
                    </td>
                    <td><img src="{{asset('assets/stem/history/'.$historyData->image)}}" alt="" width="80"></td>
                    <td>{{$historyData->years}}</td>
                    <td>{{$historyData->title}}</td>
                    <td>{{$historyData->description}}</td>
                    <td>
                      @if ($historyData->status == 1)
                        <h2 class="d-inline-block"><span class="badge badge-success">Active</span></h2>
                      @else
                        <h2 class="d-inline-block"><span class="badge badge-danger">Deactive</span></h2>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-secondary btn-sm"
                        href="{{route('admin.history.edit', $historyData->id) . '?language=' . request()->input('language')}}">
                        <span class="btn-label">
                          <i class="fas fa-edit"></i>
                        </span>
                        Edit
                      </a>
                      <form class="deleteform d-inline-block" action="{{route('admin.gallery.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{$historyData->id}}">
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
        <h5 class="modal-title" id="exampleModalLongTitle">Add Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ajaxForm" class="modal-form" action="{{route('admin.history.store')}}" method="POST">
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
  
            <div class="form-group" >
              <label for="">Years **</label>
              <input type="text" class="form-control" name="years" id="years" placeholder="Enter years" value="">
              <p id="erryears" class="mb-0 text-danger em"></p>
            </div>
  
            <div class="form-group" >
              <label for="">Title **</label>
              <input type="text" class="form-control" name="title" placeholder="Enter title" value="">
              <p id="errtitle" class="mb-0 text-danger em"></p>
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
              <label for="">Meta Description</label>
              <textarea type="text" class="form-control" name="description" rows="5"></textarea>
              <p id="errdescription" class="mb-0 text-danger em"></p>
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

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $("select[name='language_id']").on('change', function() {
      $("#gallery_category_id").removeAttr('disabled');

      let langId = $(this).val();
      let url = "{{url('/')}}/admin/gallery/" + langId + "/get_categories";

      $.get(url, function(data) {
        let options = `<option value="" disabled selected>Select a category</option>`;

        if (data.length == 0) {
          options += `<option value="" disabled>${'No Category Exists'}</option>`;
        } else {
          for (let i = 0; i < data.length; i++) {
            options +=`<option value="${data[i].id}">${data[i].name}</option>`;
          }
        }

        $("#gallery_category_id").html(options);
      });
    });

    // make input fields RTL
    $("select[name='language_id']").on('change', function() {
      $(".request-loader").addClass("show");
      let url = "{{url('/')}}/admin/rtlcheck/" + $(this).val();
      console.log(url);
      $.get(url, function(data) {
        $(".request-loader").removeClass("show");
        if (data == 1) {
          $("form input").each(function() {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });
          $("form select").each(function() {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });
          $("form textarea").each(function() {
            if (!$(this).hasClass('ltr')) {
              $(this).addClass('rtl');
            }
          });
          $("form .nicEdit-main").each(function() {
            $(this).addClass('rtl text-right');
          });
        } else {
          $("form input, form select, form textarea").removeClass('rtl');
          $("form .nicEdit-main").removeClass('rtl text-right');
        }
      });
    });
  });
</script>
@endsection
