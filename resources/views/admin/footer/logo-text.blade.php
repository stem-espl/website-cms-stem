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
    <h4 class="page-title">Logo & Text</h4>
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
        <a href="javascript:void(0)">Footer</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="javascript:void(0)">Logo & Text</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Update Logo & Text</div>
                </div>
                <div class="col-lg-2">
                    @if (!empty($langs))
                        <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">


              <form id="ajaxForm" action="{{route('admin.footer.update', $lang_id)}}" method="post">
                @csrf
                {{-- Footer Logo Part --}}
                <div class="form-group">
                    <label for="">Footer Logo ** </label>
                    <br>
                    <div class="thumb-preview" id="thumbPreview1">
                        <img src="{{asset('assets/stem/footer/'.$abs->footer_logo)}}" id="preview" alt="Footer Logo">
                    </div>
                    <br>
                    <br>


                    <input id="fileInput1" type="file" name="image" accept="image/*" hidden>
                    <label for="fileInput1" class="choose-image btn btn-primary">Choose Image</label>


                    <p class="text-warning mb-0">JPG, PNG, JPEG, SVG images are allowed</p>
                    <p id="errfooter_logo" class="em text-danger mb-0"></p>

                </div>
                <div class="form-group d-none">
                  <label for="">Footer Text **</label>
                  <input type="text" class="form-control" name="footer_text" value="{{$abs->footer_text}}">
                  <p id="errfooter_text" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group d-none">
                  <label for="">Newsletter Text **</label>
                  <input type="text" class="form-control" name="newsletter_text" value="{{$abs->newsletter_text}}">
                  <p id="errnewsletter_text" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Copyright Text **</label>
                  <textarea id="copyright_text" name="copyright_text" class="summernote form-control" data-height="150">{{convertHtml($abs->copyright_text)}}</textarea>
                  <p id="errcopyright_text" class="em text-danger mb-0"></p>
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
