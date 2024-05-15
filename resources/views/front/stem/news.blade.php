@extends('front.stem.layout')
@section('content')


<section class="page-title-section_3">
  <div class="container">
    <div class="row">
      <div class="col-xl-12 text-center">
        <div class="page-title-content">
          <h3 class="title">{{__('common.News')}}</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">{{__('common.Home')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('common.News')}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="section-content">
    <div class="container">
      <div class="row">
   
  @foreach ($data as $newsdata ) 
        <div class="col-md-6 col-lg-6 col-xl-4">
          <div class="news-wrapper mrb-30 mrb-sm-40">
            <div class="news-thumb">
              <img src="{{asset('assets/stem/news')}}/{{ $newsdata->image}}"></img>
              <div class="news-top-meta">
                <span class="entry-category">News</span>
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
  
@endsection