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
  <h4 class="page-title">Leadership Images</h4>
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
      <a href="javascript:void(0)">Leadership Management</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-4">
            <div class="card-title d-inline-block">Leadership Images</div>
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
            <a href="javascript:void(0)" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i
                class="fas fa-plus"></i> Add Image</a>
            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
              data-href="{{route('admin.leadership.bulk_delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            @if (count($leaderships) == 0)
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
                    <th scope="col">Status</th>
                    <th scope="col">Title</th>
                  
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($leaderships as $key => $lead)
                  <tr>
                    <td>
                      <input type="checkbox" class="bulk-check" data-val="{{$lead->id}}">
                    </td>
                    <td><img src="{{asset('assets/stem/leadership/'.$lead->image)}}" alt="" width="80"></td>
                    <td>
                            @if ($lead->status == 1)
                              <h2 class="d-inline-block"><span class="badge badge-success">Active</span></h2>
                            @else
                              <h2 class="d-inline-block"><span class="badge badge-danger">Deactive</span></h2>
                            @endif
                      </td>
                    <td>
                      {{strlen($lead->title) > 70 ? mb_substr($lead->name, 0, 70, 'UTF-8') . '...' : $lead->name}}
                    </td>
                    
                    <td>
                      <a class="btn btn-secondary btn-sm"
                        href="{{route('admin.leadership.edit', $lead->id) . '?language=' . request()->input('language')}}">
                        <span class="btn-label">
                          <i class="fas fa-edit"></i>
                        </span>
                        Edit
                      </a>
                      <form class="deleteform d-inline-block" action="{{route('admin.leadership.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="leadership_id" value="{{$lead->id}}">
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
        <form id="ajaxForm" class="modal-form" action="{{route('admin.leadership.store')}}" method="POST">
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
          <div class="form-group {{ $categoryInfo->gallery_category_status == 0 ? 'd-none' : '' }}">
            <label for="">Category **</label>
            <select name="lead_category_id" class="form-control" id="lead_category_id"  disabled>
              <option selected disabled>Select a category</option>
            </select> 
            <p id="errlead_category_id" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Title **</label>
            <input type="text" class="form-control" name="title" placeholder="Enter title" value="">
            <p id="errtitle" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Post **</label>
            <input type="text" class="form-control" name="postname" placeholder="Enter Post Name" value="">
            <p id="errpostname" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
            <label for="">Status*</label>
            <select name="status" class="form-control ltr">
              <option selected disabled>Select a Status</option>
              <option value="1">Active</option>
              <option value="0">Deactive</option>
            </select>
            <p id="errstatus" class="mt-1 mb-0 text-danger em"></p>
          </div>
          <div class="form-group d-none">
            <label for="">Serial Number **</label>
            <input type="number" class="form-control ltr" name="serial_number" value=""
              placeholder="Enter Serial Number">
            <p id="errserial_number" class="mb-0 text-danger em"></p>
            <p class="text-warning"><small>The higher the serial number is, the later the image will be shown.</small>
            </p>
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

@section('scripts')
<script>
  $(document).ready(function() {
    $("select[name='language_id']").on('change', function() {
      $("#lead_category_id").removeAttr('disabled');
         var id = $(this).attr('id');
          var langId = $(this).val();
          // alert(langId);
          $.ajax({
            method: 'GET',
            url: '{{ route('get_leadcategory') }}',
                data: { langId: langId , _token: '{{ csrf_token() }}' },
            
              success: function( lead_categories ) {
                var options = "";
                // let options = "<option value="" disabled selected>Select a category</option>";
                $.each(lead_categories, function(index, category) {
                    options += "<option value='" + category.id + "'>" + category.name + "</option>";
                });
                // Create new dropdown element with generated options
                // var newDropdown = $("<select class ='form-controle'>").attr("id", "lead_category_id").html(options);
                // Replace existing dropdown with new one
                // $("#lead_category_id").replaceWith(newDropdown);
                $("#lead_category_id").html(options);
          
              }
        });
      });

  });
</script>
@endsection
