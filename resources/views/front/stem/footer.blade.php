<footer class="footer">
    <div class="footer-main-area" data-background="{{asset('assets/stem/images/footer-bg.png')}}">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="widget footer-widget">
              <img src="{{asset('assets/stem/images/logo-footer.png')}}" alt="" class="mrb-20">
              <address class="mrb-25">
                @php                
                $addresses = explode(PHP_EOL, $bex->contact_addresses);
              @endphp
              @foreach ($addresses as $address)
                <p class="text-light-gray">{{$address}}</p>
                @endforeach

                @php
            $phones = explode(',', $bex->contact_numbers);
            @endphp
            @foreach ($phones as $phone)
            <div class="mrb-10"><a href="#" class="text-light-gray"><i class="fas fa-phone-alt mrr-10"></i>{{$phone}}</a></div>
            @endforeach

                @php
                  $mails = explode(',', $bex->contact_mails);
                  @endphp
                  @foreach ($mails as $mail)
                  <div class="mrb-10"><a href="#" class="text-light-gray"><i class="fas fa-envelope mrr-10"></i>{{$mail}}</a>
                  @endforeach
                </div>


                <div class="mrb-0"><a href="#" class="text-light-gray"><i class="fas fa-globe mrr-10"></i>www.stemwater.org</a></div>
                <div class="mrb-0 mt-3">
           
                    <p class="text-light-gray">{{convertUtf8($bs->contact_form_title)}}</p>
             
                </div>
              </address>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="widget footer-widget">
              <h5 class="widget-title text-white mrb-30">{{__('common.Useful Links')}}</h5>
              <ul class="footer-widget-list">
                @foreach ($ulinks as $ulink)
                <li><a href="{{ $ulink['url'] }}">{{ $ulink['name'] }}</a></li>
               @endforeach
              </ul>
            </div>
          </div>

          <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="widget footer-widget">
              <h5 class="widget-title text-white mrb-30">{{__('common.About Us')}}</h5>
              <ul class="footer-widget-list">
                @foreach ($alinks as $alink)
                <li><a href="{{ $alink['url'] }}">{{ $alink['name'] }}</a></li>
                @endforeach
              
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="widget footer-widget">
              <h5 class="widget-title text-white mrb-30">{{__('common.Department')}}</h5>
              <ul class="footer-widget-list">
                @foreach ($dlinks as $dlink)
                <li><a href="{{ $dlink['url'] }}">{{ $dlink['name'] }}</a></li>
                @endforeach
        
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
              <span class="text-light-gray">  {!! replaceBaseUrl($bs->copyright_text) !!}</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>