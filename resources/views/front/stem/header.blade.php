
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
                @includeIf('front.stem.menu')
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