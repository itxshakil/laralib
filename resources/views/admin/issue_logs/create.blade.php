@extends('layouts.admin.app')
@section('title')
    Issue Book
@endsection
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl p-2">{{ __('Issue New Book') }}</h1>
        <a href="{{route('admin.issue_logs.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            issues</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h2 class="pt-4 text-2xl text-center pb-2 md:pb-4">Issue New Book!</h2>
        <issue-book-form></issue-book-form>
    </div>
</div>
@endsection
