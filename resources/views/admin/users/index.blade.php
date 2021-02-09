@extends('layouts.admin.app')
@section('title','Users')
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl p-2">{{ __('All Users') }}</h1>
        <a href="{{route('admin.users.create')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Add
            new Student</a>
    </div>
    <users></users>
</div>
@endsection
