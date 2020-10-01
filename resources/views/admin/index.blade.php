@extends ('layouts.admin.app')

@section('content')
<div class="container mx-auto">
	<h3 class="text-2xl p-2">{{ __('Book Issued Vs Returned') }}</h3>
	<canvas id="myChart"></canvas>
	<h3 class="text-2xl p-2">{{ __('Issued current year Vs Last Year') }}</h3>
	<canvas id="lastYearIssued"></canvas>
	{{-- <div class="flex justify-between">
        <canvas id="currentStatus"></canvas>
    </div> --}}
	<div class="flex justify-between items-center pt-6">
		<h3 class="text-2xl p-2 font-semibold">{{ __('Pending Books') }}</h3>
		<a href="{{route('admin.issue_logs.index')}}"
			class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
			Issues</a>
	</div>
	<div class="flex flex-col sm:flex-row flex-wrap items-stretch">
		@forelse ($pending_issues as $issue)
		<div class="border rounded w-64 p-4 m-2 bg-gray-800 text-gray-100 flex-grow">
			<p class="text-xl">{{ $issue-> book -> title}}</p>
			<p class="mt-2">Written By @foreach($issue->book->authors as $author) <a
					href="{{route('authors.show',$author)}}">{{ $author-> name}}@if ($loop->remaining),
					@endif </a>@endforeach</p>
			<p class="text-gray-400 text-sm">ISBN : {{ $issue-> book -> isbn}}</p>
			<p class="text-gray-400 text-sm">Issued to : <a
					href="{{route('admin.users.show',$issue->user)}}">{{ $issue-> user -> name}}</a></p>
			<p class="text-gray-400 text-sm">Issued By : {{ $issue-> admin -> name}}</p>
			<p class="text-gray-400 text-sm capitalize">Issued on : {{ $issue-> created_at -> toDateString()}}</p>
		</div>
		@empty
		<p class="text-lg">No Pending Books</p>
		@endforelse
	</div>
</div>
@push('post-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
	integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg=="
	crossorigin="anonymous"></script>
<script>
	function issuedVsreturned(){
	let data = {
	labels: [
	'January',
	'February',
	'March',
	'April',
	'May',
	'June',
	'July',
	'August',
	'September',
	'October',
	'November',
	'December',
	],
	datasets: [{
	label: '# of Books Issued',
	data: [
	{{ $issuedChart->firstWhere('month','January')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','February')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','March')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','April')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','May')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','June')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','July')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','August')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','September')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','October')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','November')->data ?? 0 }},
	{{ $issuedChart->firstWhere('month','December')->data ?? 0 }},
	],
	backgroundColor: [
	'rgba(255, 99, 132, 0.2)',
	],
	borderColor: [
	'rgba(255, 99, 132, 1)',
	'rgba(255, 99, 132, 1)',
	'rgba(255, 99, 132, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(255, 206, 86, 1)',
	'rgba(255, 206, 86, 1)',
	'rgba(255, 206, 86, 1)',
	],
	borderWidth: 1
	},{
	label: '# of Books Returned',
	data: [
	{{ $returnChart->firstWhere('month','January')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','February')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','March')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','April')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','May')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','June')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','July')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','August')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','September')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','October')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','November')->data ?? 0 }},
	{{ $returnChart->firstWhere('month','December')->data ?? 0 }},
	],
	backgroundColor: [
	'rgba(152, 90 216,0.5)',
	],
	borderColor: [
	'rgba(255, 99, 132, 1)',
	'rgba(255, 99, 132, 1)',
	'rgba(255, 99, 132, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(255, 206, 86, 1)',
	'rgba(255, 206, 86, 1)',
	'rgba(255, 206, 86, 1)',
	],
	borderWidth: 1
	}],
	}
	let options = {
		responsive: true,
		maintainAspectRatio: true,
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		}
	};
	var ctx = document.getElementById('myChart');
	var myPieChart = new Chart(ctx, {
	type: 'line',
	data: data,
	options: options
	});
	}

	function currentVsLastYear(){
		let lastYeardata = {
		labels: [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December',
		],
		datasets: [{
		label: '# of Books Issued current year',
		data: [
		{{ $issuedChart->firstWhere('month','January')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','February')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','March')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','April')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','May')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','June')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','July')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','August')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','September')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','October')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','November')->data ?? 0 }},
		{{ $issuedChart->firstWhere('month','December')->data ?? 0 }},
		],
		backgroundColor: [
		'rgba(255, 99, 132, 0.2)',
		],
		borderColor: [
		'rgba(255, 99, 132, 1)',
		'rgba(255, 99, 132, 1)',
		'rgba(255, 99, 132, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(255, 206, 86, 1)',
		'rgba(255, 206, 86, 1)',
		'rgba(255, 206, 86, 1)',
		],
		borderWidth: 1
		},{
		label: '# of Books IssuedLast Year',
		data: [
		{{ $issuedLastYearChart->firstWhere('month','January')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','February')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','March')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','April')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','May')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','June')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','July')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','August')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','September')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','October')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','November')->data ?? 0 }},
		{{ $issuedLastYearChart->firstWhere('month','December')->data ?? 0 }},
		],
		backgroundColor: [
		'rgba(152, 90 216,0.5)',
		],
		borderColor: [
		'rgba(255, 99, 132, 1)',
		'rgba(255, 99, 132, 1)',
		'rgba(255, 99, 132, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(255, 206, 86, 1)',
		'rgba(255, 206, 86, 1)',
		'rgba(255, 206, 86, 1)',
		],
		borderWidth: 1
		}],
		}

		let options = {
		responsive: true,
		maintainAspectRatio: true,
		scales: {
		yAxes: [{
		ticks: {
		beginAtZero:true
		}
		}]
		}
		};

		var ctx = document.getElementById('lastYearIssued');
		var myPieChart = new Chart(ctx, {
		type: 'line',
		data: lastYeardata,
		options: options
		});
	}
	document.addEventListener('DOMContentLoaded',()=>{
		issuedVsreturned();
		currentVsLastYear();

    //     currentStatus = {
    //     labels: ['Issued', 'Available'],
    //     datasets: [{
    //         label: '# of Books',
    //         data: [ {{ \App\IssueLog::issued()->count()}},{{ App\Book::sum('count') }} ],
    //         backgroundColor: [
    //         'rgba(255, 99, 132, 0.2)',
    //         'rgba(54, 162, 235, 0.2)',
    //         ],
    //         borderColor: [
    //         'rgba(255, 99, 132, 1)',
    //         'rgba(54, 162, 235, 1)',
    //         ],
    //         borderWidth: 1
    //     }]
    // };
    //     var ctx = document.getElementById('currentStatus');
    //     var myPieChart = new Chart(ctx, {
    //     type: 'doughnut',
    //     data: currentStatus,
    //     options: {
    //     responsive: true,
    //     maintainAspectRatio: true,
    //     }
    //     });
    })
</script>
@endpush
@endsection