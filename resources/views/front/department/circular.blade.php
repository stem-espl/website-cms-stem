@extends('front.stem.layout')
@section('content')
	<section class="page-title-section_1">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title text-white circular-title">{{__($variable)}}</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="stem.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{__($variable)}}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="content pdt-60 pdb-50 table_padding">
		<div class="container">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover text-center">
					<thead class="back_color">
						<tr>
							<th>Sr No</th>
							<th>{{__($variable)}}</th>	
							<th>Download</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach ($document as $data )		
						<tr>
							<!-- <td colspan="8" class="text-center"><button type="button" class="btn btn-outline-primary">NO Data Available.</button></td> -->
							<td>{{$data->id}}</td>
							<td class="text-left">{{$data->name_mr}}</td>
							<td>
								<a class="pdf-body d-block" href="{{ asset('assets/stem/documents/'.$data->files) }}" target="_blank" rel="noopener noreferrer" download>
									<img src="{{ asset('assets/front/img/pdf.png') }}" class="text-center align-items-center" width="100">
								</a>
							</td>
							
						</tr>
						<!-- Add more rows as needed -->
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>
    @endsection