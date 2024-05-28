@extends('front.stem.layout')
@section('content')

   <style>
  .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
  </style>

<section class="page-title-section_3">
  <div class="container">
    <div class="row">
      <div class="col-xl-12 text-center">
        <div class="page-title-content">
          <h3 class="title">{{__('common.News')}}</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">{{__('common.Home')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('common.News')}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="section-content margin-to-40">
    <div class="container">
      <div class="row">

  @foreach ($data as $newsdata )
        <div class="col-md-6 col-lg-6 col-xl-4">
          <div class="news-wrapper mrb-30 mrb-sm-40">
            <div class="news-thumb">
              <img src="{{asset('assets/stem/news')}}/{{ $newsdata->image}}"></img>
              <div class="news-top-meta">
                <span class="entry-category">{{__('common.News')}}</span>
              </div>
            </div>

              <div class="news-description mb-20">
                <h4 class="the-title mrb-30">
                  <a href="{{ route('front.news.details', ['id' => $newsdata->id]) }}">
                      {{ $newsdata->title }}
                  </a>
               </h4>
              </div>

          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <nav aria-label="..." >
    <ul class="pagination pagination-lg rounded-circle" style="margin-bottom: 2%;">
      <li class="rounded-circle">{{ $data->links() }}</li>
    </ul>
  </nav>

@endsection
