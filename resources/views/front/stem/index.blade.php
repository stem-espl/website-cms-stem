@extends('front.stem.layout')
@section('content')

    @if (count($sliders) > 0)
    <section class="banner-section">
      <div class="home-carousel owl-theme owl-carousel carousel-slide">
        @foreach ($sliders as $key => $slider)
        <div class="slide-item">
          <div class="image-layer" data-background="{{asset('assets/stem/sliders/'.$slider->image)}}"></div>
          <div class="auto-container">
            <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                <div class="content-box">
                  <h1 style="font-style: italic;">{{$slider->title}}<br></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>
    @endif
    <!-- Home Slider End -->
    <!-- About Section Start -->
    <section class="about-section anim-object pdt-110 pdb-50 pdb-lg-80">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-xl-6">
            <div class="about-image-block mrb-lg-60">
              <img class="img-full" src="{{asset('assets/stem/intro')}}/{{$bs->intro_bg}}" alt="">
            </div>
          </div>
          <div class="col-md-12 col-xl-6">
            <h2 class="title-under-line mrb-70">{{$bs->intro_section_title}} <span class="f-weight-400">{{$bs->intro_section_subtitle}} </span></h2>
            <h5 class="mrb-30 text-primary-color">{{__('common.A company with difference')}}</h5>
            <p class="mrb-40">{{$bs->intro_section_text}} </p>
            <a href="{{$bs->intro_section_button_url}}" class="cs-btn-one btn-gradient-color btn-lg">{{$bs->intro_section_button_text}}</a>
          </div>
        </div>
        <div class="row mrt-100 mrt-lg-90">
        @if (count($features) > 0)
        @foreach ($features as $key => $feature)
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="funfact mrb-lg-30 mrb-60">
              @if($key == 1)
              <div class="icon">
                <span class="webexflaticon flaticon-man-2"></span>
              </div>
              @elseif($key == 2)
              <div class="icon">
                <span class="webexflaticon flaticon-trophy-1"></span>
              </div>
              @elseif($key == 3)
              <div class="icon">
                <span class="webexflaticon flaticon-briefcase-1"></span>
              </div>
              @else
              <div class="icon">
                <span class="webexflaticon flaticon-like-3"></span>
              </div>
              @endif
              <h2 class="counter">{{$feature->total_numbers}}</h2>
              <h6 class="title">{{$feature->title}}</h6>
            </div>
          </div>
          @endforeach
        @endif
          
        </div>
      </div>
    </section>
    <!-- About Section End -->
    <!-- Service Section Start -->
    @if(!empty($bs->service_section_title) || count($scategory) > 0)
    <section class="serivce-section bg-silver-light pdt-105 pdb-80" data-background="{{asset('assets/stem/images/abs-bg7.png')}}">
      @if(!empty($bs->service_section_title))
      <div class="section-title">
        <div class="container">
          <div class="row">
            <div class="col-lg-5">
              <div class="section-title-left-part mrb-sm-30">
                <div class="section-left-sub-title mb-20">
                  <h5 class="sub-title text-primary-color">{{__('common.Service We Offer')}}</h5>
                </div>
                <h2 class="title">{{$bs->service_section_title}}</h2>
              </div>
            </div>
            <div class="offset-lg-1 col-lg-6">
              <div class="section-title-right-part">
                <p>{{$bs->our_services_desc}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      @if (count($scategory) > 0)
      <div class="section-content">
        <div class="container">
          <div class="row">
            @foreach ($scategory as $key => $service)
            <div class="col-md-6 col-xl-3">
              <div class="service-box">
                <div class="service-icon">
                  <span class="webexflaticon flaticon-plan"></span>
                </div>
                <div class="service-content">
                  <div class="title">
                    <a href="javascript:void(0)">
                      <h3>{{$service->name}}</h3>
                    </a>
                  </div>
                  <div class="para">
                    <p>{{$service->short_text}}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach   
          </div>
        </div>
      </div>
      @endif
    </section>
    @endif

    @if (count($members) > 0)
    <!-- Service Section End -->
    <!-- Team Section Titile Start -->
    <section class="pdt-110 pdb-150 section-white-typo" data-background="{{asset('assets/stem/images/5.jpg')}}" data-overlay-dark="8">
      <div class="section-title text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
        <div class="container">
          <div class="row">
            <div class="col"></div>
            <div class="col-lg-8 col-xl-6">
              <div class="section-title-block">
                <!-- <h5 class="text-primary-color anim-box-objects line-both-side mrb-15">Meet Our Team</h5> -->
                <!-- <h2>Meet Our Team</h2> -->
              </div>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- Team Section Titile End -->
    <!-- Team Section Start -->
    <section class="pdt-0 pdb-20 pdb-md-110 minus-mrt-130 bg-pos-center-bottom" data-background="{{asset('assets/stem/images/abs-bg1.png')}}">
      <div class="section-content">
        <div class="container">
          <div class="row">
              @foreach ($members as $key => $member)                
                <div class="col-md-6 col-lg-6 col-xl-3 mx-5 left_margin">
                  <div class="team-block mrb-30 margin-rigt">
                    <div class="team-upper-part img_sizeset">
                      <img class="img-full sr-ias" src="{{asset('assets/stem/members/'.$member->image)}}" alt="" loading="lazy">
                    
                    </div>
                    <div class="team-bottom-part">
                      <h4 class="team-title mrb-5 name"><a href="page-single-team.html">{{$member->name}}</a></h4>
                      <h6 class="designation">{{$member->rank}}</h6>
                    </div>
                  </div>
                </div>
            @endforeach          
          </div>
        </div>
      </div>
    </section>
    @endif
    <!-- Team Section End -->

    @if(count($partners) > 0)
    <!-- STEM Shareholding Start -->
    <!-- Team Section Titile Start -->
    <section class="pdt-50 pdb-50">
      <div class="section-title text-center" >
        <div class="container">
          <div class="row">
            <div class="col"></div>
            <div class="col-lg-8 col-xl-6">
              <div class="section-title-block">
                <h2>{{__('common.STEM Shareholding')}}</h2>
              </div>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- Team Section Titile End -->
    <!-- Team Section Start -->
    <section class="pdt-0 pdb-md-110 minus-mrt-130 bg-pos-center-bottom" data-background="{{asset('assets/stem/images/abs-bg1.png')}}">
      <div class="section-content">
        <div class="container">
          <div class="row">
            @foreach($partners as $key => $partner)
            <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="mrb-30">
                <div class="team-upper-part">
                  <img class="img-full" src="{{asset('assets/stem/partners/'.$partner->image)}}" alt="">
                </div>
                <div class="team-bottom-part" style="text-align: center;">
                  <!-- <h4 class="team-title mrb-5"><a href="page-single-team.html">Thane Municipal Corporation, Thane</a></h4> -->
                  <h6>{{$partner->title}}</h6>
                  <!-- <p>Share Holding: 49.78&incare;</p> -->
                </div>
              </div>
            </div>
            @endforeach           
          </div>
        </div>
      </div>
    </section>
    @endif

    @if(count($event) > 0)
    <!-- News Section Start -->
    <section class="bg-silver-light pdt-105 pdb-80" data-background="{{asset('assets/stem/images/abs-bg4.png')}}">
      <div class="section-title mrb-30 mrb-md-60">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-xl-6">
              <h5 class="mrb-15 text-primary-color sub-title-side-line">{{__('common.News And Updates')}}</h5>
              <h2 class="mrb-30">{{__('common.Countless Update About STEM')}}</h2>
            </div>
            <div class="col-lg-4 col-xl-6 align-self-center text-left text-lg-right">
              <a href="{{route('front.stem.img')}}" class="cs-btn-one btn-gradient-color btn-md">{{__('common.All News')}}</a>
            </div>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="container">
          <div class="row">
       
      @foreach ($event as $newsdata ) 
            <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="news-wrapper mrb-30 mrb-sm-40">
                <div class="news-thumb">
                  <img src="{{asset('assets/stem/news')}}/{{ $newsdata->image}}"></img>
                  <div class="news-top-meta">
                    <span class="entry-category">{{__('common.News')}}</span>
                  </div>
                </div>
                <div class="news-details">
                  <div class="news-description mb-20">
                    <h4 class="the-title mrb-30"><a href="javascript:void(0)">{{$newsdata->title}}</a></h4>
                    <div class="news-bottom-meta">
                      <span class="entry-date mrr-20"><i class="far fa-calendar-alt mrr-10 text-primary-color"></i>{{$newsdata->date}}</span>
                      <span class="entry-author"><i class="far fa-user mrr-10 text-primary-color"></i>Admin</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    @endif
    <!-- News Section End -->
    <!-- Footer Area Start -->
    @endsection

