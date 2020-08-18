@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($book->title) }}</h3>
        <a href="{{route('admin.books.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            Books</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg lg:rounded-l-none">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Issue History of {{__($book->title)}} By
            @foreach($book->authors as $author){{$author->name}}@endforeach</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-900 text-gray-100">
                <p class="text-lg font-semibold">{{$book->title}}</p>
                <span>By</span>
                @foreach($book->authors as $author)
                <a href="{{route('admin.authors.show',$author)}}">{{$author->name}}</a>
                @endforeach
                <p class="text-gray-400 text-sm">@for ($i = 0, $rating =$book->average_rating; $i < 5; $i++)<span
                        class="@if($rating > $i)text-red-500 @endif">&hearts;</span>
                        @endfor</p>
                <div class="mt-1 flex gap-2 text-gray-300 justify-between">
                    <div>
                        <p class="text-gray-300 mt-2">ISBN: {{$book->isbn}}</p>
                        <span class="capitalize">{{$book->language}}</span>
                        <span class="ml-2 bg-indigo-700 rounded-full p-1 text-white text-xs"
                            title="Book Available Count">{{$book->count}}</span>
                    </div>
                    <div>
                        <p class="text-gray-300 mt-2">Book Issued: {{$book->issue_logs_count}}</p>
                        <p class="text-gray-300">Book Pending: {{$pending_count}}</p>
                    </div>
                </div>
            </div>
            @foreach($book->issue_logs as $issue)
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-800 text-gray-100 flex-grow">
                <a href="{{route('admin.users.show',$issue->user)}}"
                    class="text-xl font-semibold">{{$issue->user->name}}</a>
                <p class="text-sm text-gray-400">{{$issue->user->email}}</p>
                <span
                    class="inline-flex text-sm capitalize px-2 rounded-full {{$issue->returned_at ? 'text-green-200 bg-green-800' : 'text-red-200 bg-red-800'}}">{{$issue->returned_at ? 'Returned' : 'Not Returned'}}</span>
                @if ($issue->fine)
                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                    title="Total Fine">{{$issue->fine}}</span>
                @endif
                <p class="text-gray-300 mt-2">Issued : {{$issue->created_at}}</p>
                <p class="text-gray-300">Returned: {{$issue->returned_at ?? "Not Returned" }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection