@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Latest Books') }}</h3>
        <!-- <a href="{{route('admin.books.create')}}" class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Add
            new Book</a> -->
    </div>
    <div class="flex flex-col sm:flex-row flex-wrap flex-stretch gap-4 justify-center">
        @foreach($books as $book)
        <div class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 bg-gray-300 rounded p-4 shadow ">
            <a href="{{route('books.show',$book)}}" class="text-xl">{{$book->title}}</a>
            <p class="mt-2">Written By @foreach($book->authors as $author) <a href="{{route('authors.show',$author)}}">{{$author->name}}</a>@endforeach</p>
            <span class="text-gray-500 text-sm capitalize bg-gray-900 inline-block items-center px-1 rounded-full">{{$book->count ? 'Available' : 'Not Available'}}</span>
            <span class="text-gray-500 text-sm capitalize">in {{$book->language}}</span>
            <p class="text-gray-500 text-sm">Rating : {{$book->average_rating}}</p>
            <p class="text-gray-500 text-sm">ISBN : {{$book->isbn}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection