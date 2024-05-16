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
  <h4 class="page-title">Water Tariff</h4>
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
      <a href="javascript:void(0)">Water Tariff</a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-4">
            <div class="card-title d-inline-block">Water Tariff</div>
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
                class="fas fa-plus"></i> Add Water Tariff</a>
            <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete"
              data-href="{{route('admin.gallery.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">

              <form class="d-inline-block " action="{{route('admin.water.apply')}}" method="post">
                @csrf
                  <div class="form-group d-inline-block">
                      <label for="">Date:</label>
                      <input type="date"  class="form-control" name="apply" value=""  placeholder="Choose Date To Apply" required>
                      <p id="errapp" class="mb-0 text-danger em"></p>
                  </div>
                  <div class="form-group d-inline-block">
                      <input class="form-control-input" type="checkbox" value="1" id="flexCheckChecked"  name="status">
                      <label class="form-control-label" for="flexCheckChecked">
                      Is Date Apply
                      </label>
                  </div>
                  <button id="subappBtn" type="submit" class="btn btn-primary">Apply Date</button>
            </form>

          <div class="col-lg-12">
            @if (count($teriffs) == 0)
            <h3 class="text-center">NO DATA FOUND</h3>
            @else
            <div class="table-responsive">
              <table class="table table-striped mt-3" id="basic-datatables">
                <thead>
                  <tr>
                    <th scope="col">Institution Name</th>
                    <th scope="col">Water Tariff </th>
                    <th scope="col">Actions
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($teriffs as $key => $teriff)
                  <tr>
                    <td>
                      {{$teriff->institution}}
                    </td>
                    <td>{{$teriff->water_tariff}}</td>
                    <td>
                      <a class="btn btn-secondary btn-sm editbtn" href="#editModal" data-toggle="modal" data-teriff_id="{{$teriff->id}}" data-institution="{{$teriff->institution}}" data-amount="{{$teriff->water_tariff}}">
                        <span class="btn-label">
                          <i class="fas fa-edit"></i>
                        </span>
                        Edit
                      </a>
                      <form class="deleteform d-inline-block" action="{{route('admin.water.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="teriff_id" value="{{$teriff->id}}">
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
        <form id="ajaxForm" class="modal-form" action="{{route('admin.water.store')}}" method="POST">
          @csrf

          <div class="form-group">
            <label for="">Institution Name **</label>
          
            <input type="text" class="form-control" name="institution" placeholder="Enter Institution Name" value="">
         
            <p id="errinstitution" class="mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">Water Tariff **</label>
            <input type="text" class="form-control"   name="amount" maxlength="20" placeholder="Enter Water Tariff Charge" value="">
            <p id="erramount" class="mb-0 text-danger em"></p>
          </div>
          <div class="form-group">
                <label for="">Language *</label>
                <select name="language_id" class="form-control">
                    <option value="" selected disabled>Select a Language</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                </select>
                <p id="errlanguage_id" class="mt-1 mb-0 text-danger em"></p>
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


<!-- Update Gallery Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Water Tariff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ajaxEditForm" class="modal-form" action="{{route('admin.water.update')}}" method="POST">
          @csrf
          <input id="interiff_id" type="hidden" name="teriff_id" value="">
      


          <div class="form-group">
            <label for="">Institution Name **</label>
          
            <input type="text" class="form-control" id="ininstitution"  name="institution" placeholder="Enter Institution Name" value="">
         
            <p id="eerrinstitution" class="mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">Water Tariff **</label>
            <input type="text" class="form-control" name="amount" id="inamount" maxlength="20" placeholder="Enter Water Tariff Charge" value="">
            <p id="eerramount" class="mb-0 text-danger em"></p>
          </div>

       
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="updateBtn" type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

@endsection
<script>
    // JavaScript to handle form submission
    document.querySelector('form').addEventListener('submit', function(event) {
        var checkbox = document.getElementById('flexCheckChecked');
        if (!checkbox.checked) {
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
