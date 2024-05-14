@extends('front.stem.layout')
@section('content')


<section class="page-title-section_3">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title bud-title">{{__('common.Budget Reports')}}</h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="stem.html">{{__('common.Home')}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">{{__('common.Budget Reports')}}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Price Section Start -->
	<section class="feature-section pdt-20 pdb-130 bg-silver-light bg-no-repeat" data-background="{{asset('assets/stem/images/abs-bg5.png')}}">
		<div class="container">
			<div class="row">
			<div class=" col-sm-12 col-lg-12 col-md-12 col-xl-12 text-center mt-5">
				<h3>Profit in Last 6 Years (In Crores)</h3>
			</div>
			<div class="col-md-12 col-xl-12">
				<div class="container">
					<canvas id="canvas" class="mt-3 canvas_1"></canvas>
				</div>
			</div>

			</div>
		</div>
	</section>
	<!-- Price Section End -->
@endsection
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

<script type="text/javascript">
 
	var barChartData = {
  labels: [
  "2018-19",
  "2019-20",
  "2020-21",
  "2021-22",
  "2022-23",
  "2023-24 Expected",
  ],
  datasets: [
    // {
    //   label: "Revenue",
    //   backgroundColor: "#F875AA",
    //   borderColor: "pink",
    //   borderWidth: 1,
    //   data: [152.65,130.39,130.52,131.1,195.05,107.23]
    // },
    // {
    //   label: "Expenses",
    //   backgroundColor: "#01b0f1",
    //   borderColor: "#blue",
    //   borderWidth: 1,
    //   data: [129.35,98.17,84.57,77.08,43.78,93.62]
    // },
    {
      label: "Profit",
      backgroundColor: "#42955f",
      borderColor: "lightgreen",
      borderWidth: 1,
      data: [23.3,32.22,45.95,54.02,43.78,13.61]
    },
    // {
    //   label: "Taxes",
    //   backgroundColor: "#C69774",
    //   borderColor: "brown",
    //   borderWidth: 1,
    //   data: [6,9.28,12.19,12.67,10.62,3.58]
    // }
  ]
};

var chartOptions = {
  responsive: true,
  legend: {
    position: "top"
  },
  title: {
    display: true,
    // text: "Chart.js Bar Chart"
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  }
}

window.onload = function() {
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myBar = new Chart(ctx, {
    type: "bar",
    data: barChartData,
    options: chartOptions
  });
};


</script>