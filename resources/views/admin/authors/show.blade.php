@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($author->name) }}</h3>
        <a href="{{route('admin.authors.index')}}" class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All authors</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg lg:rounded-l-none">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Details of {{__($author->name)}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-300">
                <p class="text-xl font-semibold">{{$author->name}}</p>
                <p class="text-sm text-gray-700">{{$author->email}}</p>
                <p class="text-lg text-gray-800">{{$author->introduction}}</p>
                <p class="text-gray-700 mt-4">Total Book :{{$author->books_count}}</p>
            </div>
            @foreach($author->books as $book)
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-100 flex-grow">
                <a href="{{route('admin.books.show',$book)}}" class="text-lg">{{$book->title}}</a>
                <p class="text-sm text-gray-700">{{$book->isbn}}</p>
                <p class="text-gray-700 mt-2 capitalize">Language : {{$book->language}}</p>
                <p class="text-gray-700">Copies Available: {{$book->count }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection