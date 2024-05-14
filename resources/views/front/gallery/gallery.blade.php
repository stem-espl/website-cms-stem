@extends('front.stem.layout')
@section('content')

<section class="page-title-section">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-center">
				<div class="page-title-content">
					<!-- <h3 class="title text-white">Gallery</h3> -->
					<nav aria-label="breadcrumb">
						
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Gallery</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
	<!-- Page Title End -->
	<!-- Project Section Start -->
	<section class="bg-silver-light pdt-60 pdb-80" data-background="images/bg/abs-bg4.png">
		<div class="section-content">
			<div class="container">
				<div class="row">
                    <div class="col-md-12 pdb-40 text-center">					
						<h3>{{$name}}</h3>
					</div>
                    @foreach ($gallery as $galleries)
					<div class="col-md-6 col-lg-6 col-xl-4">
						<div class="case-study-item mrb-30">
							<div class="case-study-thumb">
                                <img src="{{asset('assets/stem/gallery')}}/{{ $galleries->image}}"></img>
							</div>
						</div>
					</div>
                    @endforeach
				</div>
			</div>
		</div>
	</section>
	
  
@endsection