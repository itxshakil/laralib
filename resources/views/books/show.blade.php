@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($book->title) }}</h3>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg lg:rounded-l-none">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Details of {{__($book->title)}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-300">
                <p class="text-xl">{{$book->title}}</p>
                <p class="mt-2">Written By @foreach($book->authors as $author) <a href="{{route('authors.show',$author)}}">{{$author->name}}</a>@endforeach</p>
                <span class="text-gray-500 text-sm capitalize bg-gray-900 inline-block items-center px-1 rounded-full">{{$book->count ? 'Available' : 'Not Available'}}</span>
                <span class="text-gray-500 text-sm capitalize">in {{$book->language}}</span>
                <p class="text-gray-500 text-sm capitalize">Rated  {{$book->average_rating}} ♥</p>
                <p class="text-gray-500 text-sm">ISBN : {{$book->isbn}}</p>
            </div>
            @foreach($book->ratings as $rating)
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-100 flex-grow">
                <p class="text-lg">{{$rating->comment}}</p>
                <p class="text-sm text-gray-700">{{$rating->score}}</p>
                <p class="text-gray-700 mt-2 capitalize">By : {{$rating->user->name}}</p>
                <p class="text-gray-700">on {{$rating->created_at->toDateString() }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection