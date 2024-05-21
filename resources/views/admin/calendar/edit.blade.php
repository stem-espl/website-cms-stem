@extends('admin.layout')

@if(!empty($gallery->language) && $gallery->language->rtl == 1)
@section('styles')
<style>
  form input,
  form textarea,
  form select {
    direction: rtl;
  }

  .nicEdit-main {
    direction: rtl;
    text-align: right;
  }
</style>
@endsection
@endif

@section('content')
<div class="page-header">
  <h4 class="page-title">Edit Gallery</h4>
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
      <a href="javascript:void(0)">News Page</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)">Edit News Section</a>
    </li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-inline-block">Edit News Section</div>
        <a class="btn btn-info btn-sm float-right d-inline-block"
          href="{{route('admin.news.index') . '?language=' . request()->input('language')}}">
          <span class="btn-label">
            <i class="fas fa-backward" style="font-size: 12px;"></i>
          </span>
          Back
        </a>
      </div>
      <div class="card-body pt-5 pb-5">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="ajaxForm" class="" action="{{route('admin.news.update')}}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{$event->id}}">

              <div class="form-group">
                <label for="">Image <span class="text-danger">*</span></label>
                <br>
                <div class="thumb-preview" id="thumbPreview1">
                    <img src="{{asset('assets/stem/news/')}}/{{$event->image}}" id="preview" alt="User Image">
                </div>
                <br>
                <br>

                <input id="fileInput1" type="file" name="image" accept="image/*" hidden>
                <label for="fileInput1" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG images are allowed</p>
                <p class="em text-danger mb-0" id="errfileInput1"></p>
            </div>

              <div class="form-group">
                <label for="">Title **</label>
                <input type="text" class="form-control" name="title" value="{{$event->title}}" placeholder="Enter title">
                <p id="errtitle" class="mb-0 text-danger em"></p>
              </div>

              <div class="form-group">
                <label for="">Url **</label>
                <input type="text" class="form-control" name="url" value="{{$event->url}}" placeholder="Enter title">
             
              </div>
  
            <div class="form-group">
              <label for="">Description **</label>
              <textarea
                  class="form-control"
                  name="description" id="description"
                  rows="8"
                  cols="80"
              >{{strip_tags($event->description)}}</textarea>
              <p id="errdescription" class="mb-0 text-danger em"></p>
          </div>
          

            </form>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <div class="form">
          <div class="form-group from-show-notify row">
            <div class="col-12 text-center">
              <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

        $("#fileInput1").on('change', function() {
            preview.src=URL.createObjectURL(event.target.files[0]);
        });

    });
</script>
@endsection