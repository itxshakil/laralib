@extends ('layouts.admin.app')

@section('content')
<div class="container mx-auto">
	<h3 class="text-2xl p-2">{{ __('Book Issued in Last 28 days') }}</h3>
	<canvas id="issuedChart"></canvas>
	<h3 class="text-2xl p-2">{{ __('Book Returned in Last 28 days') }}</h3>
	<canvas id="returnedChart"></canvas>
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
	function issuedIn28Days(){
	let data = {
		labels: {!!json_encode($issuedChart->keys())!!},
		datasets: [{
			label: '# of Books Issued',
			data: {!!json_encode($issuedChart->values())!!} ,
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
	var ctx = document.getElementById('issuedChart');
	var myPieChart = new Chart(ctx, {
	type: 'line',
	data: data,
	options: options
	});
	}
	function returnedIn28Days(){
	let data = {
		labels: {!!json_encode($returnedChart->keys())!!},
		datasets: [{
			label: '# of Books Returned',
			data: {!!json_encode($returnedChart->values())!!} ,
			backgroundColor: [
				'rgba(99, 255, 132, 0.2)',
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
	var ctx = document.getElementById('returnedChart');
	var myPieChart = new Chart(ctx, {
	type: 'line',
	data: data,
	options: options
	});
	}

	document.addEventListener('DOMContentLoaded',()=>{
		issuedIn28Days();
		returnedIn28Days();
    })
</script>
@endpush
@endsection