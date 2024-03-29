@extends('layouts.admin.app')
@section('title')
    Add new author
@endsection
@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl p-2">{{ __('Add new Author') }}</h1>
        <a href="{{route('admin.authors.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            Authors</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h2 class="py-4 text-2xl text-center">Add New Author!</h2>
        <form class="px-4 md:px-8  pt-6 pb-2 mb-4 bg-white rounded" method="POST"
            action="{{route('admin.authors.store')}}">
            @include('admin.authors._form')
            <section class="mb-4 text-center">
                <button
                    class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                    type="submit">
                    Add Author
                </button>
            </section>
            @csrf
        </form>
    </div>
</div>
@endsection
