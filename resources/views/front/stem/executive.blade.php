@extends('front.stem.layout')
@section('content')
<section class="page-title-section_4">
  <div class="container">
    @if (!empty($name))
    <div class="row">
      <div class="col-xl-12 text-center">
        <div class="page-title-content">
          <h3 class="title text-white">{{ convertUtf8($name) }}</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="stem.html">{{__('common.Home')}}</a></li>
              <li class="breadcrumb-item active" data-filter="" aria-current="page">{{ convertUtf8($name) }}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>
<!-- Team Section Start -->
<section class="pdt-10 pdb-80 position-relative z-index-2" data-background="images/bg/abs-bg1.png">
      <div class="section-content">
        <div class="container">
          <div class="row">
            <div class="col-md-12 pdt-40 pdb-40 text-center">
              <h3>{{ convertUtf8($name) }}</h3>
            </div>
            @if (count($leadership) > 0)
            <ul class="display-list">
              @foreach ($leadership as $leader)
              <li class="govern-council">
                <div class="img_circle">
                  <img class="img-round" src="{{asset('assets/stem/leadership')}}/{{ $leader->image}}" alt="">
                </div>
                <div class="team-bottom-part">
                  <h4 class="team-title mrb-5">{{$leader->name}}</h4>
                  <p class="designation">{{$leader->post}}</p>
                </div>
              </li>
               @endforeach
            </ul>
            @endif
          </div>
        </div>
      </div>
    </section>
<!-- Team Section End -->
@endsection