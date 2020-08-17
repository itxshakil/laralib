@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Pending Book') }}</h3>
        <a href="{{route('issues.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">My
            Issue History</a>
    </div>
    <div class="flex flex-col sm:flex-row flex-wrap">
        @forelse ($pending_issues as $issue)
        <div class="border rounded w-64 p-4 m-2 bg-gray-800 text-gray-100 flex-grow">
            <p class="text-xl">{{$issue->book->title}}</p>
            <p class="mt-2">Written By @foreach($issue->book->authors as $author) <a
                    href="{{route('authors.show',$author)}}">{{$author->name}}</a>@endforeach</p>
            <span
                class="inline-flex text-sm capitalize px-2 rounded-full {{$issue->returned_at ? 'text-green-200 bg-green-800' : 'text-red-200 bg-red-800'}}">{{$issue->returned_at ? 'Returned' : 'Not Returned'}}</span>
            @if ($issue->fine)
            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                title="Total Fine">{{$issue->fine}}</span>
            @endif
            <p class="text-gray-400 text-sm">ISBN : {{$issue->book->isbn}}</p>
            <p class="text-gray-400 text-sm capitalize">Issued on : {{$issue->created_at->toDateString()}}</p>
        </div>
        @empty
        <p class="text-lg">No Pending Books</p>
        @endforelse
    </div>
</div>
@endsection