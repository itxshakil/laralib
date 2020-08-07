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
                <p class="text-lg">{{$issue->book->title}}</p>
                <p class="text-gray-700">ISBN : {{$issue->book->isbn}}</p>
                <p class="text-gray-700">Issued : {{$issue->created_at}}</p>
                <p class="text-gray-700">Returned: {{$issue->returned_at ?? "Not Returned" }}</p>
            </div>
            @endforeach
        </div>
        <!-- <form class="px-4 md:px-8  pt-6 pb-2 mb-4 bg-white rounded" method="POST" action="{{route('admin.users.store')}}">
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="John Doe" class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('name')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="john@example.com" class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('email')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="class">
                        Class
                    </label>
                    <input type="text" name="class" id="class" value="{{old('class')}}" placeholder="BCA 1st" class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('class')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="rollno">
                        Roll Number
                    </label>
                    <input type="number" name="rollno" id="rollno" value="{{old('rollno')}}" placeholder="327166363" class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('rollno')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                        Student Password
                    </label>
                    <input type="text" name="password" id="password" value="{{old('password')}}" placeholder="password" value="password" class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('password')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <section class="mb-4 text-center">
                <button class="w-full bg-blue-500 active:bg-blue-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs" type="submit">
                    Save
                </button>
            </section>
            @csrf
        </form> -->
    </div>
</div>
@endsection