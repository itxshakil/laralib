@extends('layouts.app')
@section('title')
Details of {{__($book->title)}}
@endsection
@section('content')
<div class="container mx-auto">
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg">
        <h3 class="py-4 text-2xl text-center">Details of {{__($book->title)}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full mr-2 sm:w-1/2 rounded p-2 shadow-md bg-gray-300">
                <p class="text-xl">{{$book->title}}</p>
                <p>Written By @foreach($book->authors as $author) <a
                        href="{{route('authors.show',$author)}}">{{$author->name}}@if ($loop->remaining),
                        @endif </a>@endforeach</p>
                <span
                    class="text-sm capitalize inline-block items-center px-2 rounded-full {{$book->count ? 'bg-green-800 text-green-100' : 'bg-red-800 text-red-100'}}">{{$book->count ? 'Available' : 'Not Available'}}</span>
                <span class="text-gray-700 text-sm capitalize">in {{$book->language}}</span>
                <x-book-average-rating average-rating="{{$book->average_rating}}" />
                <p class="text-gray-700 text-sm">ISBN : {{$book->isbn}}</p>
            </div>
            @forelse($issue_logs as $issue)
            <div class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 bg-gray-800 text-gray-100 rounded p-4 shadow flex-grow">
                <p class="text-xl">{{$book->title}}</p>
                <span
                    class="inline-flex text-sm capitalize px-2 rounded-full {{$issue->returned_at ? 'text-green-200 bg-green-800' : 'text-red-200 bg-red-800'}}">{{$issue->returned_at ? 'Returned' : 'Not Returned'}}</span>
                @if ($issue->fine)
                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                    title="Total Fine">{{$issue->fine}}</span>
                @endif
                <p class="text-gray-400 text-sm">ISBN : {{$book->isbn}}</p>
                <p class="text-gray-400 text-sm capitalize">Issued on : {{$issue->created_at->format('d-M-Y')}}</p>
                @if($issue->returned_at)
                <p class="text-gray-400 text-sm capitalize">Returned on : {{$issue->returned_at->format('d-M-Y')}}</p>
                @endif
            </div>
            @empty
            <p class="pt-4 text-xl text-center pb-2 md:pb-4">You have no issue history for this book.</p>
            @endforelse
        </div>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        @can('create', [App\Rating::class, $book])
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Add New rating!</h3>
        <form class="px-4 md:px-8  pt-6 pb-2 mb-4 bg-white rounded" method="POST"
            action="{{route('rating.store',$book)}}">
            <section class="sm:mb-4 w-full">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="score">
                    Score
                </label>
                <select type="range" name="score" id="range"
                    class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
                    <option value="1">1 Very Bad</option>
                    <option value="2">2 Bad</option>
                    <option value="3">3 Average</option>
                    <option value="4" selected>4 Good</option>
                    <option value="5">5 Very Good</option>
                </select>
                @error('score')
                <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                @enderror
            </section>
            <section class="sm:mb-4 w-full">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="comment">
                    Your comment
                </label>
                <textarea name="comment" id="comment" cols="20" rows="3" value="{{old('isbn') ?? null}}"
                    placeholder="Your review about book"
                    class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"></textarea>
                @error('comment')
                <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                @enderror
            </section>
            <section class="mb-4 text-center">
                <button
                    class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                    type="submit">
                    Submit rating
                </button>
            </section>
            <input type="hidden" name="book_id" value="{{$book->id}}">
            @csrf
        </form>
        @endcan
        @guest
        <p class="pt-4 text-2xl text-center pb-2 md:pb-4">Please <a href="/login" class="text-indigo-500">Login</a> to
            rate the book.</p>
        @endguest

        <h3 class="pt-4 text-2xl pb-2 md:pb-4 underline text-center">Ratings </h3>
        @foreach($book->ratings as $rating)
        @if ($rating->comment)
        <div class="w-full rounded p-2 bg-gray-100 px-4 mb-4 shadow-lg">
            <p class="text-gray-700 mt-2 capitalize">{{$rating->user->name}}</p>
            <x-book-average-rating average-rating="{{$rating->score}}" />
            <span class="text-gray-700">on {{$rating->created_at->format('d-M-Y') }}</span>
            <p class="text-lg">{{$rating->comment}}</p>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection