@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <div class="flex flex-col sm:flex-row justify-between items-center">
        <h1 class="font-semibold text-2xl">Search Result for {{request()->input('q')}}</h1>
        <p class="mb-2">{{$books->total()}} results for {{request()->input('q')}}</p>
    </div>
    @forelse ($books as $book)
    @include('search._book')
    @empty
    <div class="rounded border flex p-2 items-center">
        <p class="text-lg">No book Found.</p>
    </div>
    @endforelse

    @if ($books->count() > 0)
    {{$books->appends(request()->input())->links('pagination.tailwind')}}
    @endif

    <div class="bg-gray-400 border p-4 rounded-md">
        <p class="font-semibold">Didn't find the book? Request new book <a class="text-indigo-600"
                href="{{route('request.books')}}">here</a></p>
    </div>
</div>
@endsection