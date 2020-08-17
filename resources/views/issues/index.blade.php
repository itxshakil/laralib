@extends('layouts.app')

@section('content')
<div class="max-w-7xl container mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Your Issue History') }}</h3>
    </div>
    <div class="flex flex-col sm:flex-row flex-wrap flex-stretch gap-4 justify-center">
        @foreach($issues as $issue)
        <div class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 bg-gray-800 text-gray-100 rounded p-4 shadow flex-grow">
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
            @if($issue->returned_at)
            <p class="text-gray-400 text-sm capitalize">Returned on : {{$issue->returned_at->toDateString()}}</p>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection