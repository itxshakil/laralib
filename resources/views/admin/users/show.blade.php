@extends('layouts.admin.app')
@section('title')
{{$user->name}}
@endsection
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl p-2">Details of {{ __($user->name) }}</h1>
        <a href="{{route('admin.users.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            Students</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h2 class="py-4 text-2xl text-center">Book Issue History of {{__($user->name)}} from
            {{$user->course->name}}</h2>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch">
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-900 text-gray-100 flex-shrink">
                <div class="flex justify-between text-gray-100">
                    <div>
                        <h3 class="text-xl font-semibold">{{$user->name}}</h3>
                        <h3 class="text-sm text-gray-400">{{$user->email}}</h3>
                    </div>
                    <div>
                        <p>{{$user->course->name}}</p>
                        <p class="text-sm text-gray-400">{{$user->rollno}}</p>
                    </div>
                </div>
                <p class="text-gray-300 mt-2">Book Issued: {{$user->issue_logs_count}}</p>
                <p class="text-gray-300">Book Pending: {{$pending_count}}</p>
            </div>
            @foreach($user->issue_logs as $issue)
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-800 text-gray-100 flex-grow">
                <a href="{{route('admin.books.show',$issue->book)}}"
                    class="text-xl font-semibold">{{$issue->book->title}}</a>
                <p class="text-gray-300">ISBN : {{$issue->book->isbn}}</p>
                <span
                    class="inline-flex text-sm capitalize px-2 rounded-full {{$issue->returned_at ? 'text-green-200 bg-green-800' : 'text-red-200 bg-red-800'}}">{{$issue->returned_at ? 'Returned' : 'Not Returned'}}</span>
                @if ($issue->fine)
                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                    title="Total Fine">₹{{$issue->fine}}</span>
                @endif
                <p class="text-gray-300">Issued : {{$issue->created_at}}</p>
                <p class="text-gray-300">Returned: {{$issue->returned_at ?? "Not Returned" }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
