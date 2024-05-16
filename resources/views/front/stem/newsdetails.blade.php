@extends('front.stem.layout')
@section('content')
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
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>


    <div class="card">
        <div class="card-body">
    <div class="jumbotron jumbotron-container">
        <div class="container">
            <div class="news-wrapper mrb-30 mrb-sm-40">
            <li class="list-group-item"> <img src="{{ asset('assets/stem/news/' . $data->image) }}" class="rounded" alt="News Image"></li>
       
            <ul class="list-group list-group-flush">
            <li class="list-group-item" style="font-size: 140%;"><b>{{__('common.Title')}}:-</b>{{ $data->title }}</li>
            <li class="list-group-item" style="font-size: 140%;"><b>{{__('common.Date')}}</b>:-{{ $data->date }}</li>
            <li class="list-group-item" style="text-wrap: pretty;"><b style="font-size: 149%;">{{__('common.Description')}}</b>:-{{ strip_tags($data->description) }}</li>
            </ul>
        </div>
            </div>
        </div>
      </div>
    </div>
    <li class="list-group-item">

@endsection

