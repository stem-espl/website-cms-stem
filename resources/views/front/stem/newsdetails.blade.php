@extends('front.stem.layout')
@section('content')
<style>
   .imgsize{

    display: flex;
   }
   .sidebar-widget {
    padding: 2px;

 }
</style>
<section class="page-title-section_3">
  <div class="container">
    <div class="row">
      <div class="col-xl-12 text-center">
        <div class="page-title-content">
          <h3 class="title">{{__('common.News Details')}}</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">{{__('common.Home')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('common.News Details')}}</li>
              <li class="breadcrumb-item active" aria-current="page">{{ $data->title}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="feature-section pdt-60 pdb-60 bg-silver-light bg-no-repeat" data-background="images/bg/abs-bg4.png">
  <div class="container">
    <div class="container-inner">
      <div class="row">
        <main id="sp-component" class="col-lg-8 ">
          <div class="sp-column ">
            <div id="system-message-container" aria-live="polite">
            </div>
            <div class="article-details " itemscope itemtype="https://schema.org/Article">
              <meta itemprop="inLanguage" content="en-GB">
              <div class="article-full-image float-left">
                <img src="{{ asset('assets/stem/news/' . $data->image) }}" itemprop="image" alt="Tech Entrepreneur Credits Paper For Success" width="775" height="575" loading="lazy">
              </div>
              <div class="article-header">
                <h1 itemprop="headline" class="new-header">
                {{ $data->title }}
                </h1>
              </div>
              <div class="article-can-edit d-flex flex-wrap justify-content-between">
              </div>
              <div itemprop="articleBody">
                <div id="sp-page-builder" class="sp-page-builder sppb-article-page-wrapper">
                  <div class="page-content">
                    <section id="section-id-1658515400617" class="sppb-section" >
                      <div class="sppb-row-container">
                        <div class="sppb-row">
                          <div class="sppb-col-md-12" id="column-wrap-id-1658515400616">
                            <div id="column-id-1658515400616" class="sppb-column" >
                              <div class="sppb-column-addons">
                                <div id="sppb-addon-wrapper-1658515400620" class="sppb-addon-wrapper">
                                  <div id="sppb-addon-1658515400620" class="clearfix "     >
                                    <div class="sppb-addon sppb-addon-text-block  mt-4">
                                      <p class="sppb-addon-title" style="word-break: break-all;"><?php $string =strip_tags($data->description) ?>

                                    {{str_replace("&nbsp;", "", $string)}} </p>
                                    @if(!empty($data->url))
                                    <a href="{{$data->url}}" class="cs-btn-one btn-gradient-color btn-lg">{{__('common.Read More')}}</a>
                                    @endif

                                      <div class="sppb-addon-content"></div>
                                    </div>
                                  </div>
                                </div>
                                <!-- <div id="sppb-addon-wrapper-1658515400623" class="sppb-addon-wrapper">
                                  <div id="sppb-addon-1658515400623" class="clearfix "     >
                                    <div class="sppb-addon sppb-addon-raw-html ">
                                      <div class="sppb-addon-content">
                                        <blockquote class="block-quote">
                                          <p>provident fugiat tempora architecto mollitia quos maiores perspiciatis obcaecati placeat aunty koi thako Architecto eaque accusamus minima in earum impedit atque</p>
                                          <span><strong class="text-secondary-color">- Sophie Brown </strong>of Google Inc.</span>
                                        </blockquote>
                                      </div>
                                    </div>
                                  </div>
                                </div> -->
                                <div id="sppb-addon-wrapper-1658515596803" class="sppb-addon-wrapper">
                                  <div id="sppb-addon-1658515596803" class="clearfix "     >
                                    <!-- <div class="sppb-addon sppb-addon-text-block  ">
                                      <p class="sppb-addon-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dolor eaque officia impedit corporis exercitationem vel nulla iure sequi ipsam.</p>
                                      <div class="sppb-addon-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem rerum voluptas harum provident fugiat tempora architecto mollitia quos maiores perspiciatis, obcaecati, placeat aut. Architecto eaque accusamus minima quis in earum dignissimos suscipit esse, saepe repudiandae similique, expedita sed quam dolore impedit deleniti atque.</p>
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        <aside id="sp-right" class="col-lg-4 ">
          <div class="sp-column ">
            <div class="sp-module ">
              <div class="sp-module-content">
                <div class="mod-sppagebuilder  sp-page-builder" data-module_id="121">
                  <div class="page-content">
                    <div id="section-id-1658514147638" class="sppb-section" >
                      <div class="sppb-container-inner">
                        <div class="sppb-row">
                          <div class="sppb-col-md-12" id="column-wrap-id-1658514147639">
                            <div id="column-id-1658514147639" class="sppb-column" >
                              <div class="sppb-column-addons">
                                <div id="sppb-addon-wrapper-1658514147642" class="sppb-addon-wrapper">
                                  <div id="sppb-addon-1658514147642" class="clearfix "     >
                                    <div class="sppb-addon sppb-addon-module sidebar-widget">
                                      <div class="sppb-addon-content">
                                        <h4 class="sppb-addon-title px-0" style ='color: #000000;'>Latest news</h4>
                                        <ul class="recent_post_item ">

                                        @foreach ($news as $newsdata )
                                          <li class="single-recent-post">
                                            <div class="thumb nex-side-box">
                                              <img src="{{asset('assets/stem/news')}}/{{ $newsdata->image}}" class ="imgsize new-post">
                                            </div>
                                            <div class="post-data new-detail">
                                              <h5 class="sidebar-title">
                                              <a href="{{ route('front.news.details', ['id' => $newsdata->id]) }}" itemprop="url">
                                              {{ $newsdata->title }} </a>
                                            </h5>
                                              <!-- <span class="time">20 July 2022</span> -->
                                            </div>
                                          </li>
                                          @endforeach

                                        </ul>
                                      </div>
                                    </div>
                                    <style type="text/css">#sppb-addon-wrapper-1658514147642 {
                                      margin:0px 0px 30px 0px;}
                                      #sppb-addon-1658514147642 {
                                      background-color: #edf0fa;
                                      box-shadow: 0 0 0 0 #ffffff;
                                      border-radius: 8px;
                                      padding:30px 30px 30px 30px;}
                                      #sppb-addon-1658514147642 {
                                      }
                                      #sppb-addon-1658514147642.sppb-element-loaded {
                                      }
                                      #sppb-addon-1658514147642 a {
                                      color: #151a33;
                                      }
                                      #sppb-addon-1658514147642 a:hover,
                                      #sppb-addon-1658514147642 a:focus,
                                      #sppb-addon-1658514147642 a:active {
                                      color: var(--maincolor);
                                      }
                                      #sppb-addon-1658514147642 .sppb-addon-title {
                                      margin-bottom:30px;color:#ffffff;}
                                      @media (min-width: 768px) and (max-width: 991px) {#sppb-addon-1658514147642 {}}@media (max-width: 767px) {#sppb-addon-1658514147642 {}}#sppb-addon-1658514147642 .sidebar-widget .sppb-addon-title{background:linear-gradient(-20deg, var(--fifthcolor), var(--secondcolor)) !important;padding:8px 24px;}#sppb-addon-1658514147642 .single-recent-post{border-bottom:1px solid #dbdde1 !important;padding-bottom:20px !important;display:flex !important;-ms-flex-align:start;align-items:center;margin-bottom:20px !important;}#sppb-addon-1658514147642 .single-recent-post:last-child{border-bottom:none !important;padding-bottom:0 !important;margin-bottom:0px !important;}#sppb-addon-1658514147642 .thumb{margin-right:20px;}#sppb-addon-1658514147642 .thumb img{border-radius:50%;}#sppb-addon-1658514147642 .sidebar-title{margin-bottom:5px;}#sppb-addon-1658514147642 .time{font-size:14px;}
                                    </style>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
@endsection
