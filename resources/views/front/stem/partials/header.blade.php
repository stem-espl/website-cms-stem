<header class="header-style-two">
  <div class="header-wrapper">
    <div class="header-top-area d-lg-block bg-secondary-color">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 header-top-left-part col-md-6 col-sm-6">
            @php
            $addresses = explode(PHP_EOL, $bex->contact_addresses);
            @endphp
            @foreach ($addresses as $address)
            <span class="address"><i class="webexflaticon flaticon-placeholder-1"></i> {{$address}}</span>
            @endforeach
            @php
            $mails = explode(',', $bex->contact_mails);
            @endphp
            @foreach ($mails as $mail)
            <span class="phone"><i class="webexflaticon flaticon-send"></i> {{$mail}}</span>
            @endforeach
          </div>
          <div class="col-lg-6 header-top-right-part text-right col-md-6 col-sm-6 margin_tp">
            <div class="language">
              <a class="language-btn" href="javascript:void(0)"><i class="webexflaticon flaticon-internet"></i> {{isset($currentLang->name) ? $currentLang->name : 'English'}}</a>
              <ul class="language-dropdown">
                @foreach ($langs as $key => $lang)
                <a class="dropdown-item" href='{{ route('changeLanguage', $lang->code) }}'>{{convertUtf8($lang->name)}}</a>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bt_blank_nav"></div>
    <div class="header-navigation-area two-layers-header header-middlee bt_stick bt_sticky">
      <div class="container mob_container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="containerNew ">
              <div class="col-sm-6 col-md-5 col-lg-9 img_padding">
                <a class="navbar-brand logo f-left mrt-5 mrt-md-0 mrb-5 mrb-md-0 pdt-10 pdb-10 padding_right logo-right-bor"  href="{{route('front.index')}}" id="logo_1" style="">
                <img id="logo-image" class="img-center img-width" src="{{asset('assets/stem/logo/'.$bs->logo)}}" alt="" loading="lazy">
                </a>
                <div class="title-full topText" >
                  <p>{{$bs->website_heading}} <br>{{$bs->website_subheading}}</p>

                </div>
              </div>
              <div class="col-sm-6 col-md-5 col-lg-3 img_padding">
                <a class="navbar-brand logo mrt-5  mrt-md-0 mrb-5 mrb-md-0 pdt-10 pdb-5" href="{{route('front.index')}}" id="logo_1" class="mx-5">
                <img id="logo-image" class="img-center header-img header-top-right-image img_width" src="{{asset('assets/stem/header_logo/'.$bs->header_logo)}}" alt="" loading="lazy">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-top-area d-lg-block bg-secondary-color bg-sec-color">
        <div class="container">
            <div class="mobile-menu-right"></div>
          <div class="row menutabs_1">
            <!-- <div class="row mx-0 menutabs_1"> -->
            <div class="col-md-12 col-lg-12 col-sm-12">

              <div class="header-searchbox-style-two d-xl-block">
                <div class="side-panel side-panel-trigger text-right d-lg-block">
                  <span class="bar1"></span>
                  <span class="bar2"></span>
                  <span class="bar3"></span>
                </div>
              </div>
              <div class="side-panel-content">
                <div class="panel-header-menu">                <div class="close-icon">
                  <button><i class="webex-icon-cross"></i></button>
                </div>
                <div class="side-panel-logo mrb-30">
                  <a href="{{route('front.index')}}">
                  <img src="{{asset('assets/stem/logo/'.$bs->logo)}}" width="261" hight="74" alt=""/>
                  </a>
                </div>
                <div class="side-info mrb-30 ">
                  <div class="side-panel-element mrb-25">
                    <h4 class="mrb-10">{{__('common.Office Address')}}</h4>
                    <ul class="list-items">
                      <li>
                        @php
                        $addresses = explode(PHP_EOL, $bex->contact_addresses);
                        @endphp
                        @foreach ($addresses as $address)
                        <span class="fa fa-map-marker-alt mrr-10 text-primary-color"></span>{{$address}}
                        @endforeach
                      </li>
                      @php
                      $mails = explode(',', $bex->contact_mails);
                      @endphp
                      @foreach ($mails as $mail)
                      <li><span class="fas fa-envelope mrr-10 text-primary-color"></span>{{$mail}}</li>
                      @endforeach
                      @php
                      $phones = explode(',', $bex->contact_numbers);
                      @endphp
                      @foreach ($phones as $phone)
                      <li><span class="fas fa-phone-alt mrr-10 text-primary-color"></span>{{$phone}}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                @if(count($socials) > 0)
                <h4 class="mrb-15">{{__('common.Social Links')}}</h4>
                <ul class="social-list">
                  @foreach ($socials as $social)
                  <li><a href="{{$social['url']}}"><i class="{{$social['icon']}}"></i></a></li>
                  @endforeach
                </ul>
                @endif
            </div>

              </div>
              @includeIf('front.stem.partials.menu')
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
<script>
  function change_lang(lang)
  {

    var lg = lang;
    alert(lg)
          $.ajax({
              method: 'POST',
              url: '{{ route('change_language') }}',
              data: { lang: lg , _token: '{{ csrf_token() }}' },
              success: function(response) {
                window.location="{{route('front.index')}}";

              }
          });
  }
</script>
