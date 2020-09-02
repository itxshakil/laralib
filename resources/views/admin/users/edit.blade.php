@extends('layouts.admin.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Edit User') }}</h3>
        <a href="{{route('admin.users.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            Students</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h3 class="py-4 text-2xl text-center">Edit Student!</h3>
        <form class="px-4 md:px-8  pt-6 pb-2 mb-4 bg-white rounded shadow" method="POST"
            action="{{route('admin.users.update',$user)}}">
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                        Name
                    </label>
                    <input type="text" name="name" id="name" value="{{old('name') ?? $user->name}}"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
                        placeholder="{{$user->name}}" required aria-required="true">
                    @error('name')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{old('email') ?? $user->email}}"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
                        placeholder="{{$user->email}}" required aria-required="true">
                    @error('email')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="course">
                        Courses
                    </label>
                    <select name="course" id="course"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
                        required aria-required="true">
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}" {{($user->course->id === $course->id) ? "selected" : null}}>
                            {{$course->name}}</option>
                        @endforeach
                    </select>
                    @error('course')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="rollno">
                        Roll Number
                    </label>
                    <input type="number" name="rollno" id="rollno" value="{{$user->rollno ?? old('rollno')}}"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
                        placeholder="{{$user->rollno}}" required>
                    @error('rollno')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <section class="mb-4 text-center">
                <button
                    class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                    type="submit">
                    Update
                </button>
            </section>
            @csrf
            @method('PUT')
        </form>
    </div>
</div>
@endsection