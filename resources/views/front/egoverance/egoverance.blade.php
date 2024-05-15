@extends('front.stem.layout')
@section('content')
	<!-- Page Title Start -->
	<section class="page-title-section_3">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title e-title">{{__('common.e-Governance')}}</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="stem.html">{{__('common.Home')}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{__('common.e-Governance')}}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page Title End -->
	<!-- Price Section Start -->
	<section class="feature-section pdt-110 pdb-130 bg-silver-light bg-no-repeat" data-background="images/bg/abs-bg5.png">
		<div class="container">
			<div class="row">
                @foreach ($egovernance as $egover )
				<div class="col-md-6 col-xl-4 mt-3">
					 <div class="feature-box mrb-lg-60">
						<div class="feature-thumb img-wrapper">					
                                <img src="{{asset('assets/stem/egovernance')}}/{{ $egover->image}}"></img>
						</div>
						<div class="feature-content">
							<div class="title">
								<h6>{{$egover->title}}</h6>
							</div>
						</div>
					</div> 
				</div>
                @endforeach
			</div>
		</div>
	</section>

    @endsection