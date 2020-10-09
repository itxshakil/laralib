@extends('layouts.admin.app')
@section('title')
    Authors
@endsection
@section('content')
<div class="container mx-autof">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Authors') }}</h3>
        <a href="{{route('admin.authors.create')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Add
            new Author</a>
    </div>
    <authors></authors>
</div>
@endsection