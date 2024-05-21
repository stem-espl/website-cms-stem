  @extends('admin.layout')

  @php
  $selLang = \App\Models\Language::where('code', request()->input('language'))->first();
  @endphp

  @section('styles')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/daterangepicker.css')}}" />
  @if(!empty($selLang) && $selLang->rtl == 1)
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
  @endif
  @endsection


  @section('content')
    <div class="page-header">
      <h4 class="page-title">News Section</h4>
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
          <a href="javascript:void(0)">News Section</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-4">
                      <div class="card-title d-inline-block">News Section</div>
                  </div>
                  <div class="col-lg-3">
                      @if (!empty($langs))
                          <select name="language" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                              <option value="" selected disabled>Select a Language</option>
                              @foreach ($langs as $lang)
                                  <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                              @endforeach
                          </select>
                      @endif
                  </div>
                  <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                      <a href="javascript:void(0)" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add News</a>
                      <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('admin.news.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                  </div>
              </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                @if (count($events) == 0)
                  <h3 class="text-center">NO NEWS FOUND</h3>
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
                          <th scope="col">url</th>
                          <th scope="col">Description</th>
                          <th scope="col">News By</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($events as $key => $event)
                          <tr>
                            <td>
                              <input type="checkbox" class="bulk-check" data-val="{{$event->id}}">
                            </td>
                            <td><img src="{{asset('assets/stem/news')}}/{{$event->image}}" alt="" width="50"></td>
                            <td>{{convertUtf8(strlen($event->title)) > 30 ? convertUtf8(substr($event->title, 0, 30)) . '...' : convertUtf8($event->title)}}</td>
              
                            @if(!empty($event->url))
                            <td>{{$event->url}}</td>
                            @else
                                <td>NA</td>
                            @endif
                                 <td>
                                  {{ strip_tags($event->description) }}
                                  </td>
                            <td>
                        {{$usename}}
                            </td>

                            <td>
                              <a class="btn btn-secondary btn-sm editbtn" href="{{route('admin.news.edit',$event->id)}}">
                                <span class="btn-label">
                                  <i class="fas fa-edit"></i>
                                </span>
                                Edit
                              </a>
                              <form class="deleteform d-inline-block" action="{{route('admin.news.delete')}}" method="post">
                                @csrf
                                <input type="hidden" name="event_id" value="{{$event->id}}">
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


    <!-- Create Event Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add News</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="ajaxForm" class="modal-form create" action="{{route('admin.news.store')}}" method="POST">
              @csrf
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
                <label for="">Image **</label>
                <input type="file" class="form-control" id="img" name="img" value="">
                <p id="errimg" class="mb-0 text-danger em"></p>
              </div>

              <div class="form-group">
                <label for="">Title **</label>
                <input name="title" class="form-control" placeholder="Enter Title" type="text" value="">
                <p id="errtitle" class="mb-0 text-danger em"></p>
              </div>



              <div class="form-group">
                <label for="">URL **</label>
                <input type="text" name="url" class="form-control ltr" placeholder="Enter URL" autocomplete="off"/>
              </div>

              <div class="form-group">
                <label for="">Description **</label>
                <textarea
                class="form-control"
                name="description" id="description"
                rows="8"
                cols="80"
                placeholder="Enter description" autocomplete="off"
                ></textarea>
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
  <script type="text/javascript" src="{{asset('assets/admin/js/plugin/daterangepicker/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/admin/js/plugin/daterangepicker/daterangepicker.js')}}"></script>

  <script>
      $(document).ready(function() {

          // make input fields RTL
          $("select[name='language_id']").on('change', function() {
              $(".request-loader").addClass("show");
              let url = "{{url('/')}}/admin/rtlcheck/" + $(this).val();
              console.log(url);
              $.get(url, function(data) {
                  $(".request-loader").removeClass("show");
                  if (data == 1) {
                      $("form.create input").each(function() {
                          if (!$(this).hasClass('ltr')) {
                              $(this).addClass('rtl');
                          }
                      });
                      $("form.create select").each(function() {
                          if (!$(this).hasClass('ltr')) {
                              $(this).addClass('rtl');
                          }
                      });
                      $("form.create textarea").each(function() {
                          if (!$(this).hasClass('ltr')) {
                              $(this).addClass('rtl');
                          }
                      });
                      $("form.create .nicEdit-main").each(function() {
                          $(this).addClass('rtl text-right');
                      });

                  } else {
                      $("form.create input, form.create select, form.create textarea").removeClass('rtl');
                      $("form.create .nicEdit-main").removeClass('rtl text-right');
                  }
              })
          });

      });
  </script>
  @endsection
