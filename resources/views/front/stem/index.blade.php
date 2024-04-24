<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Novaly">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Novaly Business Consulting HTML5 Template">
    <meta name="keywords" content=" Business, Consulting, Marketing, Agency, Creative, multipage, template" />
    <title>{{$bs->website_title}} @yield('pagename')</title>
    <link href="{{asset('assets/stem/images/favicon.png')}}" rel="shortcut icon" type="image/png">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/stem/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/stem/css/responsive.css')}}">
  </head>
  <body>
    <!-- Preloader Start -->
    <div class="preloader"></div>
    <!-- Preloader End -->
    <!-- header Start -->
    <header class="header-style-two">
      <div class="header-wrapper">
        <div class="header-top-area d-lg-block bg-secondary-color">
          <div class="container">
            <div class="row">
              <div class="col-lg-6 header-top-left-part col-md-6 col-sm-6">
                <span class="address"><i class="webexflaticon flaticon-placeholder-1"></i> Thane, Maharashtra</span>
                <span class="phone"><i class="webexflaticon flaticon-send"></i> support@stemwater.org</span>
              </div>
              <div class="col-lg-6 header-top-right-part text-right col-md-6 col-sm-6 margin_tp">
                <div class="language">
                  <a class="language-btn" href="#"><i class="webexflaticon flaticon-internet"></i> English</a>
                  <ul class="language-dropdown">
                  	@foreach($langs as $lang)
                    <li><a href="javascript:void(0)">{{$lang->name}}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bt_blank_nav"></div>
        <div class="header-navigation-area two-layers-header header-middlee bt_stick bt_sticky">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="containerNew">
                  <div class="col-sm-12 col-md-5 col-lg-9 img_padding">
                    <a class="navbar-brand logo f-left mrt-5 mrt-md-0 mrb-5 mrb-md-0 pdt-10 pdb-10 padding_right"  href="index.html" id="logo_1" style="border-right: 1px solid #000; padding-right: 12px;">
                    <img id="logo-image" class="img-center img-width" src="{{asset('assets/stem/images/logo.png')}}" alt="" loading="lazy">
                    </a>
                    <div class="title-full topText" >
                      <p><span>Stem Water Distribution And Infrastructure Company <br> Private  Limited</span><br><span>स्टेम वॉटर डिस्ट्रिब्युशन अँड इन्फ्रास्ट्रक्चर कंपनी प्रायव्हेट लिमिटेड</span></p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-5 col-lg-3 img_padding">
                    <a class="navbar-brand logo mrt-5  mrt-md-0 mrb-5 mrb-md-0 pdt-10 pdb-5" href="index.html" id="logo_1" class="mx-5">
                    <img id="logo-image" class="img-center header-top-right-image img_width" src="{{asset('assets/stem/images/clients/emblem.png')}}" alt="" loading="lazy">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="header-top-area d-lg-block bg-secondary-color bg-sec-color">
            <div class="container">
              <div class="row menutabs_1">
                <!-- <div class="row mx-0 menutabs_1"> -->
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <div class="mobile-menu-right"></div>
                  <div class="header-searchbox-style-two d-xl-block">
                    <div class="side-panel side-panel-trigger text-right d-lg-block">
                      <span class="bar1"></span>
                      <span class="bar2"></span>
                      <span class="bar3"></span>
                    </div>
                  </div>
                  <div class="side-panel-content">
                    <div class="close-icon">
                      <button><i class="webex-icon-cross"></i></button>
                    </div>
                    <div class="side-panel-logo mrb-30">
                      <a href="index.html">
                      <img src="{{asset('assets/stem/images/logo-sidebar-dark.png')}}" alt=""/>
                      </a>
                    </div>
                    <div class="side-info mrb-30">
                      <div class="side-panel-element mrb-25">
                        <h4 class="mrb-10">Office Address</h4>
                        <ul class="list-items">
                          <li><span class="fa fa-map-marker-alt mrr-10 text-primary-color"></span>Thane, Maharashtra</li>
                          <li><span class="fas fa-envelope mrr-10 text-primary-color"></span>www.stemwater.org</li>
                          <li><span class="fas fa-phone-alt mrr-10 text-primary-color"></span>(022) 2541-4739</li>
                        </ul>
                      </div>
                    </div>
                    <h4 class="mrb-15">Social List</h4>
                    <ul class="social-list">
                      <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                    </ul>
                  </div>
                  <div class="main-menu menu-colour">
                    <nav id="mobile-menu-right" >
                      <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="has-sub">
                          <a href="#">About Us</a>
                          <ul class="sub-menu">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="history.html">History</a></li>
                            <li>
                              <a href="javascript:void(0)">Budget Reports</a>
                              <ul class="sub-menu right-view">
                                <li><a href="Profit.html">Profit</a></li>
                                <!-- <li><a href="Totalincome.html">Income</a></li>
                                  <li><a href="expenses.html">Expenses</a></li> -->
                              </ul>
                            </li>
                            <li>
                              <a href="javascript:void(0)">Leadership</a>
                              <ul class="sub-menu right-view">
                                <li><a href="authority.html">Structure Of Governing Council</a></li>
                                <li><a href="executive1.html">Executive Committee</a></li>
                              </ul>
                            </li>
                            <li>
                              <a href="javascript:void(0)">Gallery</a>
                              <ul class="sub-menu right-view">
                                <li><a href="anniversary.html">13th Foundation Day Celebration</a></li>
                                <li><a href="campaign.html">53th NATIONAL SAFETY WEEK CAMPAIGN</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                        <li class="has-sub">
                          <a href="javascript:void(0)">Department</a>
                          <ul class="sub-menu">
                            <li><a href="javascript:void(0)">Administration</a></li>
                            <li>
                              <a href="javascript:void(0)">Engineering</a>
                              <ul class="sub-menu">
                                <li><a href="javascript:void(0)">Operation</a></li>
                                <li><a href="javascript:void(0)">Project</a></li>
                              </ul>
                            </li>
                            <li><a href="javascript:void(0)">Finance and Accounts</a></li>
                            <li><a href="Technicaldoc.html">Technical Documents</a></li>
                            <li><a href="circular.html">Circulars</a></li>
                            <li><a href="watertariff.html">Water Tariff and Charges</a></li>
                          </ul>
                        </li>
                        <li>
                          <a href="egoverance.html">e-Governance</a>
                        </li>
                        <li><a href="tender.html">Tender & Advertisement</a></li>
                      </ul>
                    </nav>
                  </div>
                  <div class="main-menu menu-colour">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </header>
    <!-- header End -->
    <!-- Home Slider Start -->
    <section class="banner-section">
      <div class="home-carousel owl-theme owl-carousel carousel-slide">
        <div class="slide-item">
          <div class="image-layer" data-background="{{asset('assets/stem/images/bg/1.jpg')}}"></div>
          <div class="auto-container">
            <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                <div class="content-box">
                  <h1 style="font-style: italic;">Empowering Lives Through water<br></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slide-item">
          <div class="image-layer" data-background="{{asset('assets/stem/images/Edit/DJI_0154.jpg')}}"></div>
          <div class="auto-container">
            <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                <div class="content-box">
                  <h1 style="font-style: italic;">Empowering Lives Through water<br></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slide-item">
          <div class="image-layer" data-background="images/Edit/DJI_0231.jpg"></div>
          <div class="auto-container">
            <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                <div class="content-box">
                  <h1 style="font-style: italic;">Empowering Lives Through water<br></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slide-item">
          <div class="image-layer" data-background="{{asset('assets/stem/images/Edit/DJI_0303.jpg')}}"></div>
          <div class="auto-container">
            <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                <div class="content-box">
                  <h1 style="font-style: italic;">Empowering Lives Through water<br></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slide-item">
          <div class="image-layer" data-background="{{asset('assets/stem/images/Edit/DJI_0236.jpg')}}"></div>
          <div class="auto-container">
            <div class="row clearfix">
              <div class="col-xl-8 col-lg-12 col-md-12 content-column">
                <div class="content-box">
                  <h1 style="font-style: italic;">Empowering Lives Through water<br></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Home Slider End -->
    <!-- About Section Start -->
    <section class="about-section anim-object pdt-110 pdb-50 pdb-lg-80">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-xl-6">
            <div class="about-image-block mrb-lg-60">
              <img class="img-full" src="{{asset('assets/stem/images/about/home_about.png')}}" alt="">
            </div>
          </div>
          <div class="col-md-12 col-xl-6">
            <h2 class="title-under-line mrb-70">STEM having capacity of treating 316 million+<span class="f-weight-400"> liters per day of high quality potable water per day</span></h2>
            <h5 class="mrb-30 text-primary-color">A company with difference</h5>
            <p class="mrb-40">Our mission is to provide reliable, sustainable, and accessible water services to communities, ensuring their well-being and prosperity. We are committed to innovation, responsible resource management, and delivering exceptional customer service. </p>
            <a href="about.html" class="cs-btn-one btn-gradient-color btn-lg">Know more about STEM</a>
          </div>
        </div>
        <div class="row mrt-100 mrt-lg-90">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="funfact mrb-lg-30 mrb-60">
              <div class="icon">
                <span class="webexflaticon flaticon-like-3"></span>
              </div>
              <h2 class="counter">316</h2>
              <h6 class="title">Million litres of water per day</h6>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="funfact mrb-lg-30 mrb-60">
              <div class="icon">
                <span class="webexflaticon flaticon-man-2"></span>
              </div>
              <h2 class="counter">3.5</h2>
              <h6 class="title">Million People Covered</h6>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="funfact mrb-lg-30 mrb-60">
              <div class="icon">
                <span class="webexflaticon flaticon-trophy-1"></span>
              </div>
              <h2 class="counter">35</h2>
              <h6 class="title">Villages Watered</h6>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="funfact mrb-lg-30 mrb-60">
              <div class="icon">
                <span class="webexflaticon flaticon-briefcase-1"></span>
              </div>
              <h2 class="counter">32</h2>
              <h6 class="title">Seasoned Experiences</h6>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section End -->
    <!-- Service Section Start -->
    <section class="serivce-section bg-silver-light pdt-105 pdb-80" data-background="{{asset('assets/stem/images/bg/abs-bg7.png')}}">
      <div class="section-title">
        <div class="container">
          <div class="row">
            <div class="col-lg-5">
              <div class="section-title-left-part mrb-sm-30">
                <div class="section-left-sub-title mb-20">
                  <h5 class="sub-title text-primary-color">Service We Offer</h5>
                </div>
                <h2 class="title">Our Services</h2>
              </div>
            </div>
            <div class="offset-lg-1 col-lg-6">
              <div class="section-title-right-part">
                <p>At STEM, our primary objective is to provide high-quality water supply services to Thane Municipal Corporation, Bhiwandi Nizampur Municipal Corporation, Mira Bhayander Municipal Corporation, and rural areas. We strive for excellence in managing, maintaining, and administering the water infrastructure assets entrusted to us.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-xl-3">
              <div class="service-box">
                <div class="service-icon">
                  <span class="webexflaticon flaticon-plan"></span>
                </div>
                <div class="service-content">
                  <div class="title">
                    <a href="#">
                      <h3>Uninterrupted Water Supply</h3>
                    </a>
                  </div>
                  <div class="para">
                    <p>We ensure a consistent and reliable water supply to our beneficiaries as per their allocated shares, meeting their needs efficiently.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="service-box">
                <div class="service-icon">
                  <span class="webexflaticon flaticon-meeting"></span>
                </div>
                <div class="service-content">
                  <div class="title">
                    <a href="#">
                      <h3>Industry and Commercial Supply</h3>
                    </a>
                  </div>
                  <div class="para">
                    <p>In addition to urban areas, we offer water supply solutions to industries and commercial establishments.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="service-box">
                <div class="service-icon">
                  <span class="webexflaticon flaticon-growth"></span>
                </div>
                <div class="service-content">
                  <div class="title">
                    <a href="#">
                      <h3>Environmental and Infrastructure Services</h3>
                    </a>
                  </div>
                  <div class="para">
                    <p>We engage in contracts with urban local bodies for environmental and infrastructure services, including land-fill sites.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="service-box">
                <div class="service-icon">
                  <span class="webexflaticon flaticon-benchmark"></span>
                </div>
                <div class="service-content">
                  <div class="title">
                    <a href="#">
                      <h3>Consultancy</h3>
                    </a>
                  </div>
                  <div class="para">
                    <p>We engage in contracts with urban local bodies for environmental and infrastructure services, including land-fill sites.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Service Section End -->
    <!-- Team Section Titile Start -->
    <section class="pdt-110 pdb-150 section-white-typo" data-background="{{asset('assets/stem/images/bg/5.jpg')}}" data-overlay-dark="8">
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
    <section class="pdt-0 pdb-20 pdb-md-110 minus-mrt-130 bg-pos-center-bottom" data-background="{{asset('assets/stem/images/bg/abs-bg1.png')}}">
      <div class="section-content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3 mx-5 left_margin">
              <div class="team-block mrb-30 margin-rigt">
                <div class="team-upper-part img_sizeset">
                  <img class="img-full" src="{{asset('assets/stem/images/team/ma.jpg')}}" alt="" loading="lazy">
                </div>
                <div class="team-bottom-part">
                  <h4 class="team-title mrb-5 name"><a href="page-single-team.html">Mr. Sir</a></h4>
                  <h6 class="designation">Mayor , T.M.C., Chairman</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 mx-5 left_margin">
              <div class="team-block mrb-30 margin-rigt">
                <div class="team-upper-part img_sizeset">
                  <img class="img-full sr-ias" src="{{asset('assets/stem/images/team/Sr.jpg')}}" alt="" loading="lazy">
                </div>
                <div class="team-bottom-part">
                  <h4 class="team-title mrb-5 name"><a href="page-single-team.html">Mr. Saurabh Rao (I.A.S)</a></h4>
                  <h6 class="designation">Commissioner</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 mx-5 left_margin">
              <div class="team-block mrb-30 margin-rigt">
                <div class="team-upper-part img_sizeset">
                  <img class="img-full" src="{{asset('assets/stem/images/team/sg.jpg')}}" alt="" loading="lazy">
                </div>
                <div class="team-bottom-part">
                  <h4 class="team-title mrb-5 name"><a href="page-single-team.html">Mr. Sanket Gharat</a></h4>
                  <h6 class="designation">Managing Director</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Team Section End -->
    <!-- STEM Shareholding Start -->
    <!-- Team Section Titile Start -->
    <section class="pdt-50 pdb-50">
      <div class="section-title text-center" >
        <div class="container">
          <div class="row">
            <div class="col"></div>
            <div class="col-lg-8 col-xl-6">
              <div class="section-title-block">
                <h2>STEM Shareholding</h2>
              </div>
            </div>
            <div class="col"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- Team Section Titile End -->
    <!-- Team Section Start -->
    <section class="pdt-0 pdb-md-110 minus-mrt-130 bg-pos-center-bottom" data-background="{{asset('assets/stem/images/bg/abs-bg1.png')}}">
      <div class="section-content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="mrb-30">
                <div class="team-upper-part">
                  <img class="img-full" src="{{asset('assets/stem/images/clients/thane-municipal-corporation.png')}}" alt="">
                </div>
                <div class="team-bottom-part" style="text-align: center;">
                  <!-- <h4 class="team-title mrb-5"><a href="page-single-team.html">Thane Municipal Corporation, Thane</a></h4> -->
                  <h6>Thane Municipal Corporation, Thane</h6>
                  <!-- <p>Share Holding: 49.78&incare;</p> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="mrb-30">
                <div class="team-upper-part">
                  <img class="img-full" src="{{asset('assets/stem/images/clients/mira-bhayandar-municipal-corporation.png')}}" alt="">
                </div>
                <div class="team-bottom-part" style="text-align: center;">
                  <!-- <h4 class="team-title mrb-5"><a href="page-single-team.html">Mira Bhayandar Municipal Corporation</a></h4> -->
                  <h6>Mira Bhayandar Municipal Corporation</h6>
                  <!-- <p>Share Holding: 32.55&incare;</p> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="mrb-30">
                <div class="team-upper-part">
                  <img class="img-full" src="{{asset('assets/stem/images/clients/bhiwandi-nizampur-city-municipal-corporation-bhiwandi.png')}}" alt="">
                </div>
                <div class="team-bottom-part" style="text-align: center;">
                  <!-- <h4 class="team-title mrb-5"><a href="page-single-team.html">Bhiwandi Nizampur City Municipal Corporation, Bhiwandi</a></h4> -->
                  <h6>Bhiwandi Nizampur City Municipal Corporation, Bhiwandi</h6>
                  <!-- <p>Share Holding: 14.68&incare;</p> -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
              <div class="mrb-30">
                <div class="team-upper-part">
                  <img class="img-full" src="{{asset('assets/stem/images/clients/thane-zilla-parishad-thane.png')}}" alt="">
                </div>
                <div class="team-bottom-part" style="text-align: center;">
                  <!-- <h4 class="team-title mrb-5"><a href="page-single-team.html">Thane Zilla Parishad, Thane</a></h4> -->
                  <h6>Thane Zilla Parishad, Thane</h6>
                  <!-- <p>Share Holding: 2.99&incare;</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- News Section Start -->
    <section class="bg-silver-light pdt-105 pdb-80" data-background="{{asset('assets/stem/images/bg/abs-bg4.png')}}">
      <div class="section-title mrb-30 mrb-md-60">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-xl-6">
              <h5 class="mrb-15 text-primary-color sub-title-side-line">News And Updates</h5>
              <h2 class="mrb-30">Countless Update About STEM</h2>
            </div>
            <div class="col-lg-4 col-xl-6 align-self-center text-left text-lg-right">
              <a href="news.html" class="cs-btn-one btn-gradient-color btn-md">All News</a>
            </div>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="news-wrapper mrb-30 mrb-sm-40">
                <div class="news-thumb">
                  <img class="img-full" src="{{asset('assets/stem/images/news/mediclaim.jpg')}}" alt="" loading="lazy">
                  <div class="news-top-meta">
                    <span class="entry-category">News</span>
                  </div>
                </div>
                <div class="news-details">
                  <div class="news-description mb-20">
                    <h4 class="the-title mrb-30"><a href="javascript:void(0)">Upload Mediclaim Data for year 2017-18</a></h4>
                    <div class="news-bottom-meta">
                      <span class="entry-date mrr-20"><i class="far fa-calendar-alt mrr-10 text-primary-color"></i>01 Jan, 2020</span>
                      <span class="entry-author"><i class="far fa-user mrr-10 text-primary-color"></i>Admin</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="news-wrapper mrb-30 mrb-sm-40">
                <div class="news-thumb">
                  <img class="img-full" src="{{asset('assets/stem/images/news/plantation.jpg')}}" alt="">
                  <div class="news-top-meta">
                    <span class="entry-category">News</span>
                  </div>
                </div>
                <div class="news-details">
                  <div class="news-description mb-20">
                    <h4 class="the-title mrb-30"><a href="javascript:void(0)">Tree Plantation by STEM in year 2016</a></h4>
                    <div class="news-bottom-meta">
                      <span class="entry-date mrr-20"><i class="far fa-calendar-alt mrr-10 text-primary-color"></i>01 Jan, 2021</span>
                      <!-- <span class="entry-author"><i class="far fa-user mrr-10 text-primary-color"></i>Admin</span> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="news-wrapper mrb-30 mrb-sm-40">
                <div class="news-thumb">
                  <img class="img-full" src="{{asset('assets/stem/images/news/fund.jpg')}}" alt="">
                  <div class="news-top-meta">
                    <span class="entry-category">News</span>
                  </div>
                </div>
                <div class="news-details">
                  <div class="news-description mb-20">
                    <h4 class="the-title mrb-30"><a href="javascript:void(0)">Contributed Rs 11 Lakhs to PM's National Relief Fund</a></h4>
                    <div class="news-bottom-meta">
                      <span class="entry-date mrr-20"><i class="far fa-calendar-alt mrr-10 text-primary-color"></i>01 Jan, 2022</span>
                      <!-- <span class="entry-author"><i class="far fa-user mrr-10 text-primary-color"></i>Admin</span> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- News Section End -->
    <!-- Footer Area Start -->
    <footer class="footer">
      <div class="footer-main-area" data-background="{{asset('assets/stem/images/footer-bg.png')}}">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6">
              <div class="widget footer-widget">
                <img src="{{asset('assets/stem/images/logo-footer.png')}}" alt="" class="mrb-20">
                <address class="mrb-25">
                  <p class="text-light-gray">Thane, Maharashtra</p>
                  <div class="mrb-10"><a href="#" class="text-light-gray"><i class="fas fa-phone-alt mrr-10"></i>(022) 2541 4739</a></div>
                  <div class="mrb-10"><a href="#" class="text-light-gray"><i class="fas fa-envelope mrr-10"></i>support@stemwater.org</a></div>
                  <div class="mrb-0"><a href="#" class="text-light-gray"><i class="fas fa-globe mrr-10"></i>www.stemwater.org</a></div>
                  <div class="mrb-0 mt-3">
                    <a href="#" class="text-light-gray">
                      <p>Designed And Developed By EncureIT Systems Private Limited.</p>
                    </a>
                  </div>
                </address>
                <!-- <ul class="social-list">
                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                  </ul> -->
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
              <div class="widget footer-widget">
                <h5 class="widget-title text-white mrb-30">Useful Links</h5>
                <ul class="footer-widget-list">
                  <li><a href="index.html">Home</a></li>
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="#">Department</a></li>
                  <li><a href="egoverance.html">e-Governance</a></li>
                  <li><a href="tender.html">Tender & Advertisement</a></li>
                  <li><a href="contact-us.html">Contact Us</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
              <div class="widget footer-widget">
                <h5 class="widget-title text-white mrb-30">About Us</h5>
                <ul class="footer-widget-list">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="history.html">History</a></li>
                  <li><a href="#">Budget Reports</a></li>
                  <li><a href="#">Leadership</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
              <div class="widget footer-widget">
                <h5 class="widget-title text-white mrb-30">Department</h5>
                <ul class="footer-widget-list">
                  <li><a href="#">Administration</a></li>
                  <li><a href="#">Engineering</a></li>
                  <li><a href="#">Finance and Accounts</a></li>
                  <li><a href="Technicaldoc.html">Technical Documents
                    </a>
                  </li>
                  <li><a href="circular.html">Circulars</a></li>
                  <li><a href="watertariff.html">Water Tariff and Charges</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom-area">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="text-center">
                <span class="text-light-gray">Copyright © 2023 by <a class="text-primary-color" target="_blank" href=""> STEM</a> | All rights reserved </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Area End -->
    <!-- BACK TO TOP SECTION -->
    <div class="back-to-top bg-gradient-color">
      <i class="fab fa-angle-up"></i>
    </div>
    <!-- Integrated important scripts here -->
    <script src="{{asset('assets/stem/js/jquery.v1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/stem/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/stem/js/jquery-core-plugins.js')}}"></script>
    <script src="{{asset('assets/stem/js/main.js')}}"></script>
  </body>
</html>