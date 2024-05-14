@extends('front.construction.layout')

@section('meta-keywords', "$be->home_meta_keywords")
@section('meta-description', "$be->home_meta_description")


@section('content')
    <!--   hero area start   -->
    @if ($bs->home_version == 'static')
        @includeif('front.construction.partials.static')
    @elseif ($bs->home_version == 'slider')
        @includeif('front.construction.partials.slider')
    @elseif ($bs->home_version == 'video')
        @includeif('front.construction.partials.video')
    @elseif ($bs->home_version == 'particles')
        @includeif('front.construction.partials.particles')
    @elseif ($bs->home_version == 'water')
        @includeif('front.construction.partials.water')
    @elseif ($bs->home_version == 'parallax')
        @includeif('front.construction.partials.parallax')
    @endif
    <!--   hero area end    -->

    <!-- Start finlance_feature section -->
    @if ($bs->feature_section == 1)
    <section class="finlance_feature feature_v1">
        <div class="container-fluid">
            <div class="row no-gutters">
                @foreach ($features as $key => $feature)
                    <div class="col-lg-3 col-md-6 col-sm-12 single_feature">
                        <div class="grid_item">
                            <div class="grid_inner_item d-flex align-items-center">
                                <div class="finlance_icon">
                                    <i class="{{$feature->icon}}"></i>
                                </div>
                                <div class="finlance_content">
                                    <h4>{{convertUtf8($feature->title)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_feature area -->

    <!-- Start finlance_about section -->
    @if ($bs->intro_section == 1)
    <section class="finlance_about about_v1 pt-100 pb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="finlance_box_img">
                        <div class="finlance_img">
                            <img data-src="{{asset('assets/front/img/'.$bs->intro_bg)}}" class="img-fluid lazy" alt="">
                        </div>
                        <div class="play_box">
                            <a href="{{$bs->intro_section_video_link}}" class="play_btn"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="finlance_content_box">
                        <div class="section_title">
                            <span>{{convertUtf8($bs->intro_section_title)}}</span>
                            <h2>{{convertUtf8($bs->intro_section_text)}}</h2>
                        </div>
                        @if (!empty($bs->intro_section_button_url) && !empty($bs->intro_section_button_text))
                            <div class="button_box">
                                <a href="{{$bs->intro_section_button_url}}" class="finlance_btn">{{convertUtf8($bs->intro_section_button_text)}}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_about section -->

    <!-- Start finlance_service section -->
    @if ($bs->service_section == 1)
    <section class="finlance_service service_v1 gray_bg pt-120 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title">
                        <span>{{convertUtf8($bs->service_section_title)}}</span>
                        <h2>{{convertUtf8($bs->service_section_subtitle)}}</h2>
                    </div>
                </div>
            </div>
            <div class="service_slide service-slick">
                @if (serviceCategory())
                    @foreach ($scategories as $key => $scategory)
                        <div class="grid_item">
                            <div class="grid_inner_item">
                                <div class="finlance_icon">
                                    <img data-src="{{asset('assets/front/img/service_category_icons/'.$scategory->image)}}" class="img-fluid lazy" alt="">
                                </div>
                                <div class="finlance_content">
                                    <h4>{{convertUtf8($scategory->name)}}</h4>
                                    <p class="mb-0">
                                        @if (strlen(convertUtf8($scategory->short_text)) > 112)
                                           {{mb_substr($scategory->short_text, 0, 112, 'utf-8')}}<span style="display: none;">{{mb_substr($scategory->short_text, 112, null, 'utf-8')}}</span>
                                           <a href="javascript:void(0)" class="see-more">{{__('see more')}}...</a>
                                        @else
                                           {{convertUtf8($scategory->short_text)}}
                                        @endif
                                    </p>
                                    <a href="{{route('front.services', ['category'=>$scategory->id])}}" class="btn_link d-inline-block mt-35">{{__('View Services')}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($services as $key => $service)
                        <div class="grid_item">
                            <div class="grid_inner_item">
                                @if (!empty($service->main_image))
                                    <div class="finlance_icon" style="margin-bottom: 20px;">
                                        <img data-src="{{asset('assets/front/img/services/' . $service->main_image)}}" class="lazy" alt="service" />
                                    </div>
                                @endif
                                <div class="finlance_content">
                                    <h4>{{convertUtf8($service->title)}}</h4>
                                    <p class="mb-0">
                                        @if (strlen($service->summary) > 120)
                                           {{mb_substr($service->summary, 0, 120, 'utf-8')}}<span style="display: none;">{{mb_substr($service->summary, 120, null, 'utf-8')}}</span>
                                           <a href="javascript:void(0)" class="see-more">{{__('see more')}}...</a>
                                        @else
                                           {{convertUtf8($service->summary)}}
                                        @endif
                                    </p>
                                    @if($service->details_page_status == 1)
                                        <a href="{{route('front.servicedetails', [$service->slug, $service->id])}}" class="btn_link d-inline-block mt-35">{{__('Read More')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_service section -->

    <!-- Start finlance_we_do section -->
    @if ($bs->approach_section == 1)
    <section class="finlance_we_do we_do_v1 pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="finlance_content_box">
                        <div class="section_title">
                            <span>{{convertUtf8($bs->approach_title)}}</span>
                            <h2>T{{convertUtf8($bs->approach_subtitle)}}</h2>
                        </div>
                        @if (!empty($bs->approach_button_url) && !empty($bs->approach_button_text))
                            <div class="button_box  wow fadeInUp" data-wow-delay=".4s">
                                <a href="{{$bs->approach_button_url}}" class="finlance_btn">{{convertUtf8($bs->approach_button_text)}}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="finlance_icon_box">
                        @foreach ($points as $key => $point)
                            <div class="icon_list d-flex">
                                <div class="icon">
                                    <i class="{{$point->icon}}"></i>
                                </div>
                                <div class="text">
                                    <h4>{{convertUtf8($point->title)}}</h4>
                                    <p>
                                        @if (strlen($point->short_text) > 150)
                                            {{mb_substr($point->short_text,0,150,'utf-8')}}<span style="display: none;">{{mb_substr($point->short_text,150, null,'utf-8')}}</span>
                                            <a href="javascript:void(0)" class="see-more">{{__('see more')}}...</a>
                                        @else
                                            {{convertUtf8($point->short_text)}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_we_do section -->

    <!-- Start finlance_fun section -->
    @if ($bs->statistics_section == 1)
    <section class="finlance_fun finlance_fun_v1 bg_image pt-100 pb-100" @if($bs->home_version != 'parallax') style="background-image: url('{{asset('assets/front/img/'.$be->statistics_bg)}}'); background-size:cover;" @endif id="statisticsSection" @if($bs->home_version == 'parallax') data-parallax="scroll" data-speed="0.2" data-image-src="{{asset('assets/front/img/'.$be->statistics_bg)}}" @endif>
        <div class="container">
            <div class="row">
                @foreach ($statistics as $key => $statistic)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="counter_box">
                            <div class="icon">
                                <i class="{{$statistic->icon}}"></i>
                            </div>
                            <h2><span class="counter">{{convertUtf8($statistic->quantity)}}</span>+</h2>
                            <p>{{convertUtf8($statistic->title)}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_fun section -->

    <!-- Start finlance_testimonial section -->
    @if ($bs->testimonial_section == 1)
    <section class="finlance_testimonial testimonial_v1 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <span>{{convertUtf8($bs->testimonial_title)}}</span>
                        <h2>{{convertUtf8($bs->testimonial_subtitle)}}</h2>
                    </div>
                </div>
            </div>
            <div class="testimonial_slide">
                @foreach ($testimonials as $key => $testimonial)
                    <div class="testimonial_box d-flex align-items-center">
                        <div class="finlance_img">
                            <img data-src="{{asset('assets/front/img/testimonials/'.$testimonial->image)}}" class="img-fluid lazy" alt="">
                        </div>
                        <div class="finlance_content">
                            <h4>{{convertUtf8($testimonial->name)}}</h4>
                            <h6>{{convertUtf8($testimonial->rank)}}</h6>
                            <p>{{convertUtf8($testimonial->comment)}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_testimonial section -->

    <!-- Start finlance_project section -->
    @if ($bs->portfolio_section == 1)
    <section class="finlance_project project_v1 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title">
                        <span>{{convertUtf8($bs->portfolio_section_title)}}</span>
                        <h2>{{convertUtf8($bs->portfolio_section_text)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="project_slide project-slick">
                @foreach ($portfolios as $key => $portfolio)
                    <div class="grid_item">
                        <div class="grid_inner_item">
                            <div class="finlance_img">
                                <img data-src="{{asset('assets/front/img/portfolios/featured/'.$portfolio->featured_image)}}" class="img-fluid lazy" alt="">
                                <div class="overlay_img"></div>
                                <div class="overlay_content">
                                    <div class="button_box">
                                        <a href="{{route('front.portfoliodetails', [$portfolio->slug, $portfolio->id])}}" class="finlance_btn">{{__('View More')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="finlance_content">
                                <h4>{{strlen($portfolio->title) > 25 ? mb_substr($portfolio->title, 0, 25, 'utf-8') . '...' : $portfolio->title}}</h4>

                                @if (!empty($portfolio->service))
                                    <p>{{convertUtf8($portfolio->service->title)}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_project section -->

    <!-- Start finlance_pricing section -->
    @if ($be->pricing_section == 1)
    <section class="finlance_pricing pricing_v1 pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <span>{{convertUtf8($be->pricing_title)}}</span>
                        <h2>{{convertUtf8($be->pricing_subtitle)}}</h2>
                    </div>
                </div>
            </div>
            <div class="pricing_slide pricing-slick">
                @foreach ($packages as $key => $package)
                    <div class="pricing_box text-center">
                        <div class="pricing_title">
                            <h3>{{convertUtf8($package->title)}}</h3>
                            <p>{{__('Featured Package')}}</p>
                        </div>
                        <div class="pricing_price">
                            <h3>{{$bex->base_currency_symbol_position == 'left' ? $bex->base_currency_symbol : ''}} {{$package->price}} {{$bex->base_currency_symbol_position == 'right' ? $bex->base_currency_symbol : ''}}</h3>
                        </div>
                        <div class="pricing_body">
                            {!! replaceBaseUrl(convertUtf8($package->description)) !!}
                        </div>
                        <div class="pricing_button">
                            @if ($package->order_status == 1)
                                <a href="{{route('front.packageorder.index', $package->id)}}" class="finlance_btn">{{__('Place Order')}}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_pricing section -->


    <!-- Start finlance_team section -->
    @if ($bs->team_section == 1)
    <section class="finlance_team team_v1 gray_bg pt-100 pb-75">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section_title">
                        <span>{{convertUtf8($bs->team_section_title)}}</span>
                        <h2>{{convertUtf8($bs->team_section_subtitle)}}</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="button_box">
                        <a href="{{route('front.team')}}" class="btn_link">{{__('View More')}}</a>
                    </div>
                </div>
            </div>
            <div class="team_slide team-slick">
                @foreach ($members as $key => $member)
                    <div class="grid_item">
                        <div class="grid_inner_item">
                            <div class="finlance_img">
                                <img data-src="{{asset('assets/front/img/members/'.$member->image)}}" class="img-fluid lazy" alt="">
                                <div class="overlay_content">
                                    <div class="social_box">
                                        <ul>
                                            @if (!empty($member->facebook))
                                                <li><a href="{{$member->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                            @if (!empty($member->twitter))
                                                <li><a href="{{$member->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            @endif
                                            @if (!empty($member->linkedin))
                                                <li><a href="{{$member->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                            @endif
                                            @if (!empty($member->instagram))
                                                <li><a href="{{$member->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="finlance_content text-center">
                                <h4>{{convertUtf8($member->name)}}</h4>
                                <p>{{convertUtf8($member->rank)}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_team section -->

    <!-- Start finlance_blog section -->
    @if ($bs->news_section == 1)
    <section class="finlance_blog blog_v1 pt-125">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center">
                        <span>{{convertUtf8($bs->blog_section_title)}}</span>
                        <h2>{{convertUtf8($bs->blog_section_subtitle)}}</h2>
                    </div>
                </div>
            </div>
            <div class="blog_slide blog-slick">
                @foreach ($blogs as $key => $blog)
                    <div class="grid_item">
                        <div class="grid_inner_item">
                            <div class="finlance_img">
                                <a href="{{route('front.blogdetails', [$blog->slug, $blog->id])}}"><img data-src="{{asset('assets/front/img/blogs/'.$blog->main_image)}}" class="img-fluid lazy" alt=""></a>
                            </div>
                            <div class="finlance_content">
                                <div class="post_meta">
                                    @php
                                        $blogDate = \Carbon\Carbon::parse($blog->created_at)->locale("$currentLang->code");
                                        $blogDate = $blogDate->translatedFormat('d M. Y');
                                    @endphp
                                    <span><i class="far fa-user"></i><a href="javascript:void(0)">{{__('By')}} {{__('Admin')}}</a></span>
                                    <span><i class="far fa-calendar-alt"></i><a href="javascript:void(0)">{{$blogDate}}</a></span>
                                </div>
                                <h3 class="post_title"><a href="{{route('front.blogdetails', [$blog->slug, $blog->id])}}">{{strlen($blog->title) > 40 ? mb_substr($blog->title, 0, 40, 'utf-8') . '...' : $blog->title}}</a></h3>
                                <a href="{{route('front.blogdetails', [$blog->slug, $blog->id])}}" class="btn_link">{{__('Read More')}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_blog section -->

    <!-- Start finlance_partner section -->
    @if ($bs->partner_section == 1)
    <section class="finlance_partner partner_v1 pt-125 pb-125">
        <div class="container">
            <div class="partner_slide">
                @foreach ($partners as $key => $partner)
                    <div class="single_partner">
                        <a href="{{$partner->url}}"><img data-src="{{asset('assets/front/img/partners/'.$partner->image)}}" class="img-fluid lazy" alt=""></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_partner section -->

    <!-- Start finlance_cta section -->
    @if ($bs->call_to_action_section == 1)
    <section class="finlance_cta cta_v1 main_bg pt-70 pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="section_title">
                        <h2 class="text-white">{{convertUtf8($bs->cta_section_text)}}</h2>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="button_box">
                        <a href="{{$bs->cta_section_button_url}}" class="finlance_btn">{{convertUtf8($bs->cta_section_button_text)}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End finlance_cta section -->

@endsection
