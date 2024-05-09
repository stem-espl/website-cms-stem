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
    <h4 class="page-title">Document Update</h4>
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
        <a href="{{route('admin.tenders.index')}}">Document</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="javascript:void(0)">Document Update</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card-title">Document Update</div>
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
              <form id="ajaxForm" action="{{route('admin.documents.update')}}" method="post">
                <input type="hidden" name="document_id" value="{{$document->id}}">
                @csrf
                <div class="form-group">
                  <label for="">Document Category **</label>
                  <select class="form-control" name="document">
                    <option value="">Select</option>
                      @foreach ($documentCat as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $document->document_category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach

                  </select>
                  <p id="errtender_category" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">document in English **</label>
                  <input type="text" class="form-control" name="e_name" value="{{$document->name}}" placeholder="Enter title in english">
                  <p id="errtitle" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">document in Marathi **</label>
                  <input type="text" class="form-control" name="m_name" value="{{$document->name_mr}}" placeholder="Enter title in marathi">
                  <p id="errtitle_mr" class="em text-danger mb-0"></p>
                </div>

                <div class="form-group">
                  <label for="">Status **</label>
                  <select class="form-control ltr" name="status">
                    <option value="" selected disabled>Select a status</option>
                    <option value="1" <?php if($document->status == '1') echo "selected";?>>Active</option>
                    <option value="0" <?php if($document->status == '0') echo "selected";?>>Deactive</option>
                  </select>
                  <p id="errstatus" class="mb-0 text-danger em"></p>
                </div>

                <div class="form-group">
                  <div id="downloadFile" class="form-group">
                      <label for="">Document **</label>
                      <br>
                      <input name="documents" type="file" accept="application/pdf" >
                      <p class="mb-0 text-warning">Only PDF file is allowed. File size should be less than 2MB.</p>
                      <p id="errtender_doc" class="mb-0 text-danger em"></p>
                  </div>
                  @if(!empty($document->files))
                  <div class="row ">
                    <div class="col-sm-3 col-md-2 col-lg-6 col-xl-4">
                      <div class="pdf">
                          <a href="javascript:void(0)" class="delete_file pdf-delete img-circle"><strong>&times;</strong></a>
                        <a class="pdf-body d-block" href="{{asset('assets/stem/documents')}}/{{$document->files}}" download><img src="{{asset('assets/front/img/pdf.png')}}" class="text-center align-items-center" width="100"></a>
                      </div>
                    </div>
                  </div>
                  @endif
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
