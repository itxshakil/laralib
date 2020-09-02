@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="w-full bg-gray-200 p-2 shadow rounded-lg">
        <h3 class="py-4 text-2xl text-center">Request New Book!</h3>
        @if (session('message'))
        <p class="text-center italic text-green-500 mb-2">
            {{ session('message') }}
        </p>
        @endif
        <form class="px-4 md:px-8 pt-6 pb-2 mb-4 bg-white shadow rounded" method="POST"
            action="{{route('request.books.store')}}">
            @csrf
            @auth
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            @endauth
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                        Book name
                    </label>
                    <input type="text" name="name" id="name" value="{{old('name') ?? null }}"
                        placeholder="Programming with Java A Primer"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 @error('name') border-red-500 @enderror"
                        required aria-required="true" autofocus>
                    @error('name')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="author">
                        Author name
                    </label>
                    <input type="text" name="author" id="author" value="{{old('author') ?? null }}"
                        placeholder="E. Balagurusamy"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 @error('author') border-red-500 @enderror"
                        required aria-required="true">
                    @error('author')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="isbn">
                        ISBN Number(optional)
                    </label>
                    <input type="number" name="isbn" id="isbn" maxlength="13" minlength="10"
                        value="{{old('isbn') ?? null}}" placeholder="0070617139"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 @error('isbn') border-red-500 @enderror">
                    @error('isbn')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="publisher">
                        Publisher(optional)
                    </label>
                    <input type="text" name="publisher" id="publisher" value="{{old('publisher')  ?? null }}"
                        placeholder="McGraw Hill Publishing House"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 @error('publisher') border-red-500 @enderror">
                    @error('publisher')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="blockF mb-2 text-sm font-bold text-gray-700" for="year">
                        Year
                    </label>
                    <input type="number" name="year" id="year" minlength="4" maxlength="4"
                        value="{{old('year') ?? now()->year}}" placeholder="2020"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 @error('year') border-red-500 @enderror">
                    @error('year')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <section class="sm:mb-4 w-full">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="message">
                    Message(optional)
                </label>
                <textarea name="message" id="message" cols="30" rows="3" value="{{old('message')}}"
                    placeholder="Additional Details about book"
                    class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"></textarea>
                @error('message')
                <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                @enderror
            </section>
            <section class="mb-4 text-center">
                <button
                    class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                    type="submit">
                    Request Book
                </button>
            </section>
            @csrf
        </form>
    </div>
</div>
@endsection