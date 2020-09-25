@extends ('layouts.admin.app')

@section('content')
<div class="container mx-auto">
    <h3 class="text-2xl p-2">{{ __('Book Issued and Returned') }}</h3>
    <canvas id="myChart" width="400" height="400" style="width:100%; max-width:660px !important;"></canvas>
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Pending Book') }}</h3>
        <a href="{{route('admin.issue_logs.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            Issues</a>
    </div>
    <div class="flex flex-col sm:flex-row flex-wrap items-center">
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
    // var Chart = require('chart.js');
    document.addEventListener('DOMContentLoaded',()=>{
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
            label: '# of Issued Books',
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
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
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
            label: '# of Returned Books',
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
            'rgba(152 90 216,1)',
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
        var ctx = document.getElementById('myChart');
        // let data = {
        //     label: 'Books Issue Data',
        //     datasets: [{
        // data: [10, 20, 30]
        // }],
        // backgroundColor: [
        // 'rgba(255, 99, 132, 0.2)',
        // 'rgba(54, 162, 235, 0.2)',
        // 'rgba(255, 206, 86, 0.2)',
        // // 'rgba(75, 192, 192, 0.2)',
        // // 'rgba(153, 102, 255, 0.2)',
        // // 'rgba(255, 159, 64, 0.2)'
        // ],
        // borderColor: [
        // 'rgba(255, 99, 132, 1)',
        // 'rgba(54, 162, 235, 1)',
        // 'rgba(255, 206, 86, 1)',
        // // 'rgba(75, 192, 192, 1)',
        // // 'rgba(153, 102, 255, 1)',
        // // 'rgba(255, 159, 64, 1)'
        // ],
        // borderWidth: 1,

        // // These labels appear in the legend and in the tooltips when hovering different arcs
        // labels: [
        // 'Returned',
        // 'Issued',
        // 'Available'
        // ]};
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
        var myPieChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
        });
        // var myChart = new Chart(ctx, {
        // type: 'bar',
        // data: {
        // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        // datasets: [{
        // label: '# of Votes',
        // data: [12, 19, 3, 5, 2, 3],
        // backgroundColor: [
        // 'rgba(255, 99, 132, 0.2)',
        // 'rgba(54, 162, 235, 0.2)',
        // 'rgba(255, 206, 86, 0.2)',
        // 'rgba(75, 192, 192, 0.2)',
        // 'rgba(153, 102, 255, 0.2)',
        // 'rgba(255, 159, 64, 0.2)'
        // ],
        // borderColor: [
        // 'rgba(255, 99, 132, 1)',
        // 'rgba(54, 162, 235, 1)',
        // 'rgba(255, 206, 86, 1)',
        // 'rgba(75, 192, 192, 1)',
        // 'rgba(153, 102, 255, 1)',
        // 'rgba(255, 159, 64, 1)'
        // ],
        // borderWidth: 1
        // }]
        // },
        // options: {
        // scales: {
        // yAxes: [{
        // ticks: {
        // beginAtZero: true
        // }
        // }]
        // }
        // }
        // });
    })
</script>
@endpush
@endsection