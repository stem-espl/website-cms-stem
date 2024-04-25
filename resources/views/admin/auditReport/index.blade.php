@extends('admin.layout')

@section('content')
<div class="page-header">
  <h4 class="page-title">Audit</h4>
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
      <a href="javascript:void(0)">Audit Page</a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="javascript:void(0)">Audit</a>
    </li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-4">
            <div class="card-title d-inline-block">Audit</div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-striped mt-3 yajra-datatable" id="auditReport">
                  <thead>
                    <tr>
                      <th class="border-bottom-0">Event</th>
                      <th class="border-bottom-0">Event By</th>
                      <th class="border-bottom-0">Date & Time</th>
                      <th class="border-bottom-0">New values</th>
                      <th class="border-bottom-0">Old values</th>
                      <!-- <th class="border-bottom-0">Action</th> -->
                     
                     
                      
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
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
    $('#auditReport').dataTable( {
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "order": [0, 'desc'],
        "ajax": {
            "url": "{{ route('audit-from') }}",
            "type": "GET"
        },
        "columns": [
            { "data": "event" },
            { "data": "user_id" },
            { "data": "created_at" },
            { "data": "new_values", render: function(data,type,row) {
                data = '<div style="height:95px; overflow-y:auto;width:400px;overflow-x:auto;">'+data+'</div>';
                return data;
              }
            },
            { "data": "old_values", render: function(data,type,row) {
                dat = '<div style="height:95px; overflow-y:auto; width:300px;overflow-x:auto;">'+data+'</div>';
                return dat;
              }
            },
            // { "data": "action" }
           
        ],
      } 
    );
  });
</script>
@endsection