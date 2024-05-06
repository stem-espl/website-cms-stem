@extends('front.stem.layout')
@section('content')

<section class="page-title-section_4">
		<div class="container">
        @if (!empty($name))



			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title text-white">BOARD OF DIRECTORS</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="stem.html">Home</a></li>
								<li class="breadcrumb-item active" data-filter="" aria-current="page">{{ convertUtf8($name) }}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
     
            @endif
		</div>
	</section>
    <!-- Team Section Start -->
	<section class="pdt-10 pdb-80 position-relative z-index-2" data-background="images/bg/abs-bg1.png">
		<div class="section-content">
			<div class="container">
				<div class="row">
					<div class="col-md-12 pdt-40 pdb-40 text-center">
						<h3> BOARD OF DIRECTORS</h3>
					</div>
                    @if (count($leadership) > 0)
                          @foreach ($leadership as $leader)
					<div class="col-md-6 col-lg-6 col-xl-3">
						<div class="team-block team-block-leadership mrb-30">
                        
							<div class="team-upper-part">
								<img class="img-full" src="{{asset('assets/stem/leadership')}}/{{ $leader->image}}" alt="">
							</div>
							<div class="team-bottom-part">
								<h4 class="team-title mrb-5"><a href="page-single-team.html"> {{$leader->name}}</a></h4>
								<h6 class="designation">{{$leader->post}}</h6>
							</div>
                           
						</div>
					</div>
                    @endforeach
                          @endif
                  
			
			
				
				</div>
			</div>
		</div>
	</section>
	<!-- Team Section End -->

@endsection