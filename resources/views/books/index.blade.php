@extends('layouts.app')

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
                    href="{{route('authors.show',$author)}}">{{$author->name}}</a>@endforeach</p>
            <span
                class="text-gray-400 text-sm capitalize bg-gray-900 inline-block items-center px-2 rounded-full">{{$book->count ? 'Available' : 'Not Available'}}</span>
            <span class="text-gray-400 text-sm capitalize">in {{$book->language}}</span>
            <p class="text-gray-400 text-sm">@for ($i = 0; $i < 5; $i++)<span
                    class="@if($book->average_rating > $i)text-red-500 @endif">♥</span>
                    @endfor</p>
            <p class="text-gray-400 text-sm">ISBN : {{$book->isbn}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection