@extends('front.stem.layout')
@section('content')
  <section class="page-title-section_1">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 text-center">
          <div class="page-title-content">
            <h3 class="title text-white tender-title">{{__('common.Tender/Advertisement')}}</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('front.index')}}">{{__('common.Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('common.Tender/Advertisement')}}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content pdt-60 pdb-50">
    <div class="container">
      <div class="table-responsive">
        <table id="example12" class="table table-bordered table-striped table-hover text-center">
          <thead>
            <tr>
              <th>{{__('common.Tender Number')}}</th>
              <th>{{__('common.Tender Information')}}</th>
              <th>{{__('common.E-Tender link')}}</th>
              <th>{{__('common.Tender File')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tenders as $row)
            <tr>
              <td>{{$row->id}}</td>
              <td class="text-left">{{$row->title}}</td>
              <td>
                @if(!empty($row->tender_link))
                <a href="{{$row->tender_link}}">{{__('common.Click Here')}}</a>
                @else
                  NA
                @endif
              </td>
              <td>
                <a class="pdf-body d-block" href="{{asset('assets/stem/tenders')}}/{{$row->files}}" target="_blank"> <img src="{{asset('assets/front/img/pdf.png')}}" class="text-center align-items-center" width="100">
								</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="container">
           {{$tenders->appends(['language' => request()->input('language')])->links()}}
        </div>
      </div>
    </div>
  </section>
@endsection

<!-- 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
  $(function () {
    $("#example12").DataTable({
      "responsive": true,
      "lengthChange": false,
      "searching": false,
      "language": {
          "search": "{{__('common.Search')}}:",
          "sEmptyTable": "{{__('common.No records available')}}",
          "oPaginate": {
              "sFirst": "{{__('common.First')}}", // This is the link to the first page
              "sPrevious": "{{__('common.Previous')}}", // This is the link to the previous page
              "sNext": "{{__('common.Next')}}", // This is the link to the next page
              "sLast": "{{__('common.Last')}}" ,// This is the link to the last page
          },
          "info": "{{__('common.info_page')}}" // This is the link to the last page
      },
    });
  });

</script> -->