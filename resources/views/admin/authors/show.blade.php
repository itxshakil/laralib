@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($author->name) }}</h3>
        <a href="{{route('admin.authors.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            authors</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h3 class="py-4 text-2xl text-center">Books of {{__($author->name)}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch">
            <div class="w-full sm:w-1/2 rounded p-2 border bg-gray-900 text-gray-100">
                <p class="text-xl font-semibold">{{$author->name}}</p>
                <p class="text-sm text-gray-500">{{$author->email ?? "Email Not Available"}}</p>
                <p class="text-lg text-gray-300">{{$author->introduction ?? "Intro. Not Available"}}</p>
                <p class="text-gray-300 mt-4">Total Book :{{$author->books_count}}</p>
            </div>
            @foreach($author->books as $book)
            <div class="w-full sm:w-64 rounded p-2 border bg-gray-800 text-gray-100 flex-grow">
                <a href="{{route('admin.books.show',$book)}}" class="text-xl font-semibold">{{$book->title}}</a>
                <p class="text-sm text-gray-300">{{$book->isbn}}</p>
                <p class="text-gray-300 mt-2 capitalize">Language : {{$book->language}}</p>
                <p class="text-gray-300">Copies Available: {{$book->count }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection