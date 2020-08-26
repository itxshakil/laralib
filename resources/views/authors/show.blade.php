@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($author->name) }}</h3>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg lg:rounded-l-none">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Details of {{__($author->name)}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full sm:w-1/2 rounded p-2 border bg-gray-300">
                <p class="text-xl font-semibold">{{$author->name}}</p>
                <p class="text-sm text-gray-700">{{$author->email}}</p>
                <p class="text-lg text-gray-800">{{$author->introduction}}</p>
                <p class="text-gray-700 mt-4">Total Book :{{$author->books_count}}</p>
            </div>
            @foreach($author->books as $book)
            <div class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 bg-gray-800 text-gray-100 rounded p-4 shadow flex-grow">
                <a href="{{route('books.show',$book)}}" class="text-xl">{{$book->title}}</a>
                <div><span
                        class="text-sm capitalize inline-block items-center px-2 rounded-full {{$book->count ? 'bg-green-800 text-green-100' : 'bg-red-800 text-red-100'}}">{{$book->count ? 'Available' : 'Not Available'}}</span>
                    <span class="text-gray-400 text-sm capitalize">in {{$book->language}}</span></div>
                <x-book-average-rating average-rating="{{$book->average_rating}}" />
                <p class="text-gray-400 text-sm">ISBN : {{$book->isbn}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection