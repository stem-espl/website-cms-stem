@extends('front.stem.layout')
@section('content')
	<!-- Page Title Start -->
	<section class="page-title-section_1">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title text-white water-title">{{__('common.Water Tariff And Charges')}}</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="stem.html">{{__('common.Home')}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{__('common.Water Tariff And Charges')}}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="content pdt-60 pdb-50">
		<div class="container">
			<div class="row mrb-60">
				<div class="col-xl-12">
				   <h2 class=" pdt-20 pdb-20 text-center table_padding">{{__('common.Water Tariff And Charges')}}</h2>
				   <!-- <p class="text-center">STEM Water Distribution & Infrastructure Co. Pvt. Ltd. is a private limited company jointly owned by Thane Municipal Corporation, Bhiwandi Nizampur Municipal Corporation, Mira Bhayander Municipal Corporation, and Thane Zilla Parishad. With decades of experience in the water sector, we are dedicated to ensuring uninterrupted water supply to our valued beneficiaries.</p> -->
			   </div>
		   </div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover text-center">
					<thead class="back_color">
						<tr>
							<!-- <th> Sr. No.</th> -->
							<th>{{__('common.Sr.No')}}.</th>
							<th>{{__('common.Institution')}}</th>
							<th>{{__('common.Water Rate')}} 
								@if(!empty($date))
								({{__('common.Dt.')}} {{$date}} {{__('common.From')}})
								@endif
							</th>
						</tr>
					</thead>
					<tbody>
					@if (count($data) == 0)
           				 <h3 class="text-center">{{__('common.NO DATA FOUND')}}</h3>
           			@else
                    @foreach ($data as $key=>$val)
						<tr>
							<td class="text-center">{{$key+1}} </td>
							<td class="text-left">{{$val->institution}}<br>
							
							<td class="text-center">{{$val->water_tariff}}</td>
								
							
						</tr>
                        @endforeach
                    @endif
						<!-- <tr>
							<td class="text-center">2. </td>
							<td class="text-left">मिरा भाईंदर महानगरपालिका</td>
							<td class="text-center">१२,६००</td>
							
						</tr>
						<tr>
							<td class="text-center">3. </td>
							<td class="text-left"> भिवंडी निजामपूर शहर महानगरपालिका</td>
							<td class="text-center">११,९००</td>
							
						</tr>
						<tr>
							<td class="text-center">4. </td>
							<td class="text-left"> जिल्हा परिषद (३६ ग्रामपंचायती)</td>
							<td class="text-center">९६००</td>
							
						</tr>
						 -->
						<!-- Add more rows as needed -->
					</tbody>
				</table>
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