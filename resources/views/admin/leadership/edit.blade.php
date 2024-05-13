@extends('admin.layout')

@if(!empty($leadership->language) && $leadership->language->rtl == 1)
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
  <h4 class="page-title">Edit Leadership</h4>
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
      <a href="#">Leadership Page</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#">Edit Leadership</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-inline-block">Edit Leadership</div>
        <a class="btn btn-info btn-sm float-right d-inline-block"
          href="{{route('admin.leadership.index') . '?language=' . request()->input('language')}}">
          <span class="btn-label">
            <i class="fas fa-backward" style="font-size: 12px;"></i>
          </span>
          Back
        </a>
      </div>
      <div class="card-body pt-5 pb-5">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="ajaxForm" class="" action="{{route('admin.leadership.update')}}" method="post">
              @csrf
              <input type="hidden" name="leadership_id" value="{{$leadership->id}}">

              {{-- Image Part --}}
              <div class="form-group">
                <label for="">Image <span class="text-danger">*</span></label>
                <br>
                <div class="thumb-preview" id="thumbPreview1">
                    <img src="{{asset('assets/stem/leadership/')}}/{{$leadership->image}}" id="preview" alt="User Image">
                </div>
                <br>
                <br>

                <input id="fileInput1" type="file" name="image" accept="image/*" hidden>
                <label for="fileInput1" class="choose-image btn btn-primary">Choose Image</label>
                <p class="text-warning mb-0">JPG, PNG, JPEG, SVG images are allowed</p>
                <p class="em text-danger mb-0" id="errimage"></p>
            </div>

              <div class="form-group {{ $categoryInfo->gallery_category_status == 0 ? 'd-none' : '' }}">
                <label for="">Category **</label>
                <select name="category_id" class="form-control">
                  <option disabled selected>Select a category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $leadership->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
                </select>
                <p id="eerrcategory_id" class="mb-0 text-danger em"></p>
              </div>
              <div class="form-group">
                <label for="">Title **</label>
                <input type="text" class="form-control" name="title" value="{{$leadership->name}}" placeholder="Enter title">
                <p id="errtitle" class="mb-0 text-danger em"></p>
              </div>
              <div class="form-group">
                <label for="">Post **</label>
                <input type="text" class="form-control" name="postname" value="{{$leadership->post}}" placeholder="Enter Post Name">
                <p id="errpost" class="mb-0 text-danger em"></p>
              </div>

              <div class="form-group">
                <label for="">Category Status*</label>
                <select name="status" id="instatus" class="form-control">
               
                  <option disabled>Select a Status</option>
                  <option value="1" <?php echo ($leadership->status == 1) ? 'selected' : ''; ?>>Active</option>
                  <option value="0" <?php echo ($leadership->status == 0) ? 'selected' : ''; ?>>Deactive</option>
                </select>
                <p id="eerrstatus" class="mt-1 mb-0 text-danger em"></p>
            </div>
              <div class="form-group d-none">
                <label for="">Serial Number **</label>
                <input type="number" class="form-control ltr" name="serial_number" value="{{$leadership->serial_number}}"
                  placeholder="Enter Serial Number">
                <p id="errserial_number" class="mb-0 text-danger em"></p>
                <p class="text-warning"><small>The higher the serial number is, the later the image will be
                    shown.</small></p>
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