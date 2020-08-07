@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($user->name) }}</h3>
        <a href="{{route('admin.users.index')}}" class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All Students</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg lg:rounded-l-none">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Book Issue History of {{__($user->name)}} from {{$user->course->name}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-300">
                <div class="flex justify-between text-gray-700">
                    <div>
                        <p class="text-lg">{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                    </div>
                    <div>
                        <p>{{$user->course->name}}</p>
                        <p>{{$user->rollno}}</p>
                    </div>
                </div>
                <p class="text-gray-700 mt-2">Book Issued: {{$user->issue_logs_count}}</p>
                <p class="text-gray-700">Book Pending: {{$pending_count}}</p>
            </div>
            @foreach($user->issue_logs as $issue)
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-100 flex-grow">
                <a href="{{route('admin.books.show',$issue->book)}}" class="text-lg">{{$issue->book->title}}</a>
                <p class="text-gray-700">ISBN : {{$issue->book->isbn}}</p>
                <p class="text-gray-700">Issued : {{$issue->created_at}}</p>
                <p class="text-gray-700">Returned: {{$issue->returned_at ?? "Not Returned" }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection