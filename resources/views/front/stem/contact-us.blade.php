@extends('front.stem.layout')
@section('content')


	<!-- Page Title Start -->
	<section class="page-title-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title text-white">{{__('common.Contact Us')}}</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">{{__('common.Home')}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{__('common.Contact Us')}}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page Title End -->
	<!-- Contact Section Start -->
	<section class="contact-section pdt-110 pdb-95 pdb-lg-90" data-background="images/bg/abs-bg1.png">
		<div class="container">
			<div class="row mrb-40">
				<div class="col-lg-6 col-xl-4">
					<div class="contact-block d-flex mrb-30">
						<div class="contact-icon">
							<i class="webex-icon-map1"></i>
						</div>
                        
						<div class="contact-details mrl-30">
							<h5 class="icon-box-title mrb-10">{{__('common.Our Address')}}</h5>
							<p class="mrb-0">{{$bex->contact_addresses}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-4">
					<div class="contact-block d-flex mrb-30">
						<div class="contact-icon">
							<i class="webex-icon-Phone2"></i>
						</div>
						<div class="contact-details mrl-30">
							<h5 class="icon-box-title mrb-10">{{__('common.Phone Number')}}</h5>
							<p class="mrb-0">{{$bex->contact_numbers}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-xl-4">
					<div class="contact-block d-flex mrb-30">
						<div class="contact-icon">
							<i class="webex-icon-envelope"></i>
						</div>
						<div class="contact-details mrl-30">
							<h5 class="icon-box-title mrb-10">{{__('common.Email Us')}}</h5>
							<p class="mrb-0">{{$bex->contact_mails}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 col-xl-5">
					<h5 class="sub-title-side-line text-primary-color mrt-0 mrb-15">{{__('common.Get In Touch')}}</h5>
					<h2 class="faq-title mrb-30">{{$bs->contact_form_title}}</h2>
					<p class="mrb-40">{{$bs->contact_form_subtitle}}</p>
					<ul class="social-list list-lg list-primary-color list-flat mrb-md-60 clearfix">
                    @foreach ($socials as $social)
                    <li><a href="{{$social['url']}}"><i class="{{$social['icon']}}"></i></a></li>
                    @endforeach
						<!-- <li><a href="javascript:void(0)"><i class="fab fa-facebook"></i></a></li>
						<li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
						<li><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
						<li><a href="javascript:void(0)"><i class="fab fa-google-plus"></i></a></li> -->
					</ul>
				</div>
				<div class="col-lg-7 col-xl-7">
					<div class="contact-form">
						<form action="{{route('contact.query')}}" method="post" >
                            @csrf
                          
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group mrb-25">
										<input type="text" id="name" name="name"  placeholder="{{__('common.Name')}}" class="form-control formerror"  required>
                                        @if ($errors->has('name'))
                                         <p class="text-danger text-left">{{$errors->first('name')}}</p>
                                        @endif
									</div>
								</div>
								<div class="col-lg-6">
                              
									<div class="form-group mrb-25">
										<input type="text" id="phone" name="phone" placeholder="{{__('common.Phone')}}" class="form-control"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                                        @if ($errors->has('phone'))
                                         <p class="text-danger text-left">{{$errors->first('phone')}}</p>
                                        @endif
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group mrb-25">
										<input type="email" id="email" name="email" placeholder="{{__('common.Email')}}" class="form-control" required maxlength="70">
                                        @if ($errors->has('email'))
                                         <p class="text-danger text-left">{{$errors->first('email')}}</p>
                                        @endif
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group mrb-25">
										<textarea rows="4"  id="msg" name="message" placeholder="{{__('common.Messages')}}" class="form-control" required></textarea>
                                        @if ($errors->has('message'))
                                         <p class="text-danger text-left">{{$errors->first('message')}}</p>
                                        @endif
									</div>
								</div>
								<div class="col-lg-8">
									<div class="form-group">
										<button type="submit" name="submit" class="cs-btn-one btn-md btn-round btn-primary-color element-shadow">{{__('common.Submit Now')}}</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="contact-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 p-0">
					<!-- Google Map Start -->
					<div class="mapouter fixed-height">
						<div class="gmap_canvas">
							<iframe src="https://maps.google.com/maps?hl=en&amp;q={{$bex->latitude}},%20{{$bex->longitude}}+(My%20Business%20Name)&amp;t=&amp;iwloc=B&amp;output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

							<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30144.129575814713!2d72.91804991083987!3d19.19449489999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b98afd56474d%3A0xea24082cae5602ed!2sStem%20Water%20Distribution%20And%20Infrastructure%20Co.P.Ltd.!5e0!3m2!1sen!2sin!4v1698842740640!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
							<a href="https://www.whatismyip-address.com/"></a> -->
						</div>
					</div>
					<!-- Google Map End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Contact Section End -->
  
@endsection