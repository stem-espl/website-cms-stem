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
						@if(!empty($egover->url))
						<div class="feature-thumb img-wrapper">					
                                <a href="{{$egover->url}}"><img src="{{asset('assets/stem/egovernance')}}/{{ $egover->image}}"></img></a>
						</div>
						@else
						
						<div class="feature-thumb img-wrapper">
							<img class="img-full" src="{{asset('assets/stem/egovernance')}}/{{ $egover->image}}" alt="" loading="lazy"  onclick="openImagePopup(this)">
						</div>
						@endif
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
	
	<script>
		function openImagePopup(element) {
			var imageUrl = element.src;
			var imagePopup = document.createElement('div');
			imagePopup.className = 'image-popup';
			
			var popupImage = document.createElement('img');
			popupImage.className = 'popup-image';
			popupImage.src = imageUrl;
			imagePopup.appendChild(popupImage);
			
			// Close button
			var closeButton = document.createElement('span');
			closeButton.className = 'close-button';
			closeButton.innerHTML = '&times;';
			closeButton.onclick = function() {
				imagePopup.style.display = 'none';
			};
			imagePopup.appendChild(closeButton);
			
			document.body.appendChild(imagePopup);
			imagePopup.style.display = 'block';
		}
	</script>
