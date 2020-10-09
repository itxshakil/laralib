@extends('layouts.app')
@section('title')
{{ __('Latest Books') }}
@endsection
@section('content')
<div class="container mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Latest Books') }}</h3>
    </div>
    <div class="flex flex-col sm:flex-row flex-wrap flex-stretch gap-4 justify-center">
        @foreach($books as $book)
        <div class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 bg-gray-800 text-gray-100 rounded p-4 shadow flex-grow">
            <a href="{{route('books.show',$book)}}" class="text-xl">{{$book->title}}</a>
            <p class="mt-2">Written By @foreach($book->authors as $author) <a
                    href="{{route('authors.show',$author)}}">{{$author->name}}@if ($loop->remaining),
                    @endif </a>@endforeach</p>
            <span
                class="text-sm capitalize inline-block items-center px-2 rounded-full {{$book->count ? 'bg-green-800 text-green-100' : 'bg-red-800 text-red-100'}}">{{$book->count ? 'Available' : 'Not Available'}}</span>
            <span class="text-gray-400 text-sm capitalize">in {{$book->language}}</span>
            <x-book-average-rating average-rating="{{$book->average_rating}}" />
            <p class="text-gray-400 text-sm">ISBN : {{$book->isbn}}</p>
        </div>
        @endforeach
    </div>
    @if ($books->count() > 0)
    {{$books->links()}}
    @endif
</div>
@endsection