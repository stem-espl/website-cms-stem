@extends('front.stem.layout')
@section('content')


<div class="containar-flude">
  <div class="row">
    <div class="col-4" style="margin-top: 13%;">
      <div class="btn-group btn-group-toggle" data-toggle="buttons" style="margin-left: 39%;">
        <label class="btn btn-secondary active">
          <input type="radio" name="options" id="option1">Home
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="options" id="option2" autocomplete="off">News
        </label>
      </div>

    </div>
    <div class="col-8">
      <img src="{{ url('assets/news.jpg') }}" alt=""  style="margin-top: 2%;">

    </div>
  </div>
</div>

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