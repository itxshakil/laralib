@extends('layouts.admin.app')
@section('title')
{{$author->name}}
@endsection
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl p-2">Details of {{ __($author->name) }}</h1>
        <a href="{{route('admin.authors.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            authors</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h2 class="py-4 text-2xl text-center">Books of {{__($author->name)}}</h2>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch">
            <div class="w-full sm:w-1/2 rounded p-2 border bg-gray-900 text-gray-100">
                <h3 class="text-xl font-semibold">{{$author->name}}</h3>
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
