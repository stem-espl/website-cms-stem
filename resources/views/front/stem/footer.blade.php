<footer class="footer">
    <div class="footer-main-area" data-background="{{asset('assets/stem/images/footer-bg.png')}}">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="widget footer-widget">
              <img src="{{asset('assets/stem/images/logo-footer.png')}}" alt="" class="mrb-20">
              <address class="mrb-25">
                <p class="text-light-gray">
                  @php
              $addresses = explode(PHP_EOL, $bex->contact_addresses);
              @endphp
              @foreach ($addresses as $address)
              <p class="float-left w-md-75 mb-0">{{$address}}</p>
              @endforeach
                </p>
                <br>
                <div class="mrb-10"><a href="#" class="text-light-gray"><i class="fas fa-phone-alt mrr-10"></i>(022) 2541 4739</a></div>
                <div class="mrb-10"><a href="#" class="text-light-gray"><i class="fas fa-envelope mrr-10"></i>support@stemwater.org</a></div>
                <div class="mrb-0"><a href="#" class="text-light-gray"><i class="fas fa-globe mrr-10"></i>www.stemwater.org</a></div>
                <div class="mrb-0 mt-3">
           
                    <p>{{convertUtf8($bs->contact_form_title)}}</p>
             
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
                @foreach ($ulinks as $manu)
                <li><a href="{{ $manu['url'] }}">{{ $manu['name'] }}</a></li>
               @endforeach
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
              <span class="text-light-gray">  {!! replaceBaseUrl($bs->copyright_text) !!}</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>