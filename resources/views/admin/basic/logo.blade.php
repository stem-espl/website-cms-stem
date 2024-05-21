@extends('admin.layout')
@section('content')
<div class="page-header">
  <h4 class="page-title">Logo</h4>
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
      <a href="javascript:void(0)">Basic Settings</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)">Logo</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-12">
            <div class="card-title">Update Logo</div>
          </div>
        </div>
      </div>
      <div class="card-body pt-5 pb-4">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="imageForm" action="{{route('admin.logo.update')}}" method="POST"  enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Website Heading **</label>
                <input class="form-control" name="website_heading" value="{{$abs->website_heading}}" placeholder="Enter Titlte">
                @if ($errors->has('website_heading'))
                <p class="mb-0 text-danger">{{$errors->first('website_heading')}}</p>
                @endif
              </div>
              <div class="form-group">
                <label>Website Sub Heading **</label>
                <input class="form-control" name="website_subheading" value="{{$abs->website_subheading}}" placeholder="Enter Sub Titlte">
                @if ($errors->has('website_subheading'))
                <p class="mb-0 text-danger">{{$errors->first('website_subheading')}}</p>
                @endif
              </div>
              {{-- Logo Part --}}
              <div class="form-group">
                <label for="">Logo ** </label>
                <br>
                <div class="thumb-preview" id="thumbPreview1">
                  <img src="{{asset('assets/stem/logo/' . $abs->logo)}}" id="preview" alt="Logo">
                </div>
                <br>
                <br>
                <input id="fileInput1" type="file" name="logo" accept="image/*" hidden>
                <label for="fileInput1" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG images are allowed</p>
                @if ($errors->has('logo'))
                <p class="text-danger mb-0">{{$errors->first('logo')}}</p>
                @endif
              </div>
              {{-- Favicon Part --}}
              <div class="form-group">
                <label for="">Favicon ** </label>
                <br>
                <div class="thumb-preview" id="thumbPreview2">
                  <img src="{{asset('assets/stem/favicon/' . $abs->favicon)}}" id="preview1" alt="favicon">
                </div>
                <br>
                <br>
                <input id="fileInput2" type="file" name="favicon" accept="image/*" hidden>
                <label for="fileInput2" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG, SVG, SVG images are allowed</p>
                @if ($errors->has('favicon'))
                <p class="text-danger mb-0">{{$errors->first('favicon')}}</p>
                @endif
              </div>
              {{-- Breadcrumb Part --}}
              <div class="form-group">
                <label for="">Breadcrumb ** </label>
                <br>
                <div class="thumb-preview" id="thumbPreview3">
                  <img src="{{asset('assets/stem/breadcrumb/' . $abs->breadcrumb)}}" id="preview2" alt="breadcrumb">
                </div>
                <br>
                <br>
                <input id="fileInput3" type="file" name="breadcrumb" accept="image/*" hidden>
                <label for="fileInput3" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG, SVG images are allowed</p>
                @if ($errors->has('breadcrumb'))
                <p class="text-danger mb-0">{{$errors->first('breadcrumb')}}</p>
                @endif
              </div>
              {{-- Header Logo Part --}}
              <div class="form-group">
                <label for="">Header Logo ** </label>
                <br>
                <div class="thumb-preview" id="thumbPreview4">
                  <img src="{{asset('assets/stem/header_logo/' . $abs->header_logo)}}" id="preview3" alt="headerlogo">
                </div>
                <br>
                <br>
                <input id="fileInput4" type="file" name="header_logo" accept="image/*" hidden>
                <label for="fileInput4" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG, SVG images are allowed</p>
                @if ($errors->has('header_logo'))
                <p class="text-danger mb-0">{{$errors->first('header_logo')}}</p>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-success" form="imageForm">Update</button>
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

        $("#fileInput2").on('change', function() {
            preview1.src=URL.createObjectURL(event.target.files[0]);
        });

        $("#fileInput3").on('change', function() {
            preview2.src=URL.createObjectURL(event.target.files[0]);
        });

        $("#fileInput4").on('change', function() {
            preview3.src=URL.createObjectURL(event.target.files[0]);
        });
    });
</script>
@endsection
