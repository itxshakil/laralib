@extends('layouts.admin.app')
@section('title')
Books
@endsection
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl p-2">{{ __('All Books') }}</h1>
        <a href="{{route('admin.books.create')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Add
            new Book</a>
    </div>
    <books></books>
</div>
@endsection
