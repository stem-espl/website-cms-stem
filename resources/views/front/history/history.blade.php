@extends('front.stem.layout')
@section('content')
<section class="page-title-section_4">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <div class="page-title-content">
                    <h3 class="title text-white history-title">Water Delivered, Hassle-Free</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="stem.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Water Delivered, Hassle-Free</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature-section pdt-60 pdb-60 bg-silver-light bg-no-repeat" data-background="images/bg/abs-bg4.png">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pdt-40 pdb-40 text-center">
                <h1>Water Delivered, Hassle-Free</h1>
            </div>
            @foreach($historyData as $history)
            <div class="col-md-6 col-xl-4">
                <div class="feature-box mrb-lg-60">
                     <div class="feature-thumb">
                        <img src="{{asset('assets/stem/history')}}/{{ $history->image}}"></img>
                    </div> 
                    <div class="feature-content">
                        <div class="title">
                            <h3>{{$history->years}}</h3>
                        </div>
                        <!-- <div class="para">
                            <p>MAHARASHTRA WATER SUPPLY SEWERAGE BOARD.</p>
                        </div> -->
                        <div class="para">
                            <h5>{{$history->title}}</h5>
                        </div>
                        <div class="para">
                            <p>{{$history->description}}</p>
                        </div>
                        <!-- <div class="link">
                            <a href="javascript:void(0)"><i class="fas fa-long-arrow-alt-right"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>  
            @endforeach
        </div>
    </div>
</section>
@endsection