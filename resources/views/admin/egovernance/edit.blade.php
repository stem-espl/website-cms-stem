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
  <h4 class="page-title">Edit E-Governance</h4>
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
      <a href="javascript:void(0)">E-Governance Page</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)">Edit E-Governance</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-inline-block">Edit E-Governance</div>
        <a class="btn btn-info btn-sm float-right d-inline-block"
          href="{{route('admin.egovernance.index') . '?language=' . request()->input('language')}}">
          <span class="btn-label">
            <i class="fas fa-backward" style="font-size: 12px;"></i>
          </span>
          Back
        </a>
      </div>
      <div class="card-body pt-5 pb-5">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="ajaxForm" class="" action="{{route('admin.egovernance.update')}}" method="post">
              @csrf
              <input type="hidden" name="egovernan_id" value="{{$egovernan->id}}">

              {{-- Image Part --}}
              <div class="form-group">
                <label for="">Image <span class="text-danger">*</span></label>
                <br>
                <div class="thumb-preview" id="thumbPreview1">
                    <img src="{{asset('assets/stem/egovernance/')}}/{{$egovernan->image}}" id="preview" alt="User Image">
                </div>
                <br>
                <br>

                <input id="image" type="file" name="image" accept="image/*" hidden>
                <label for="fileInput1" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG images are allowed</p>
                <p class="em text-danger mb-0" id="errimage"></p>
               </div>

              <div class="form-group">
                <label for="">Title **</label>
                <input type="text" class="form-control" name="title" value="{{$egovernan->title}}" placeholder="Enter title">
                <p id="errtitle" class="mb-0 text-danger em"></p>
              </div>

              <div class="form-group">
                <label for="">URL **</label>
                <input type="text" class="form-control" name="url" value="{{$egovernan->url}}" placeholder="Enter title">
                <p id="errurl" class="mb-0 text-danger em"></p>
              </div>

              <div class="form-group">
                <label for="">Status**</label>
                <select class="form-control" name="status" aria-label=".form-select-lg example">
                <option value="1" <?php echo ($egovernan->status == 1) ? 'selected' : ''; ?>>Active</option>
                  <option value="0" <?php echo ($egovernan->status == 0) ? 'selected' : ''; ?>>Deactive</option>
                  <p id="errstatus" class="mb-0 text-danger em"></p>
                </select>

               
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
