@extends('layouts.admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __('Edit Book') }}</h3>
        <a href="{{route('admin.books.index')}}"
            class="align-baseline py-2 px-4 border border-transparent text-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">All
            Books</a>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg shadow">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Edit Book!</h3>
        <form class="px-4 md:px-8  pt-6 pb-2 mb-4 bg-white rounded" method="POST"
            action="{{route('admin.books.update',$book)}}">
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="title">
                        Title
                    </label>
                    <input type="text" name="title" id="title" value="{{old('title') ?? $book->title ?? null }}"
                        placeholder="Song of Ice and Fire"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('title')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="isbn">
                        ISBN Number
                    </label>
                    <input type="number" name="isbn" id="isbn" value="{{old('isbn') ?? $book->isbn ?? null}}"
                        placeholder="7894561231234"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('isbn')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="count">
                        Count
                    </label>
                    <input type="number" name="count" id="count" value="{{old('count') ?? $book->count ?? null }}"
                        placeholder="25 "
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('count')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="language">
                        Language
                    </label>
                    <input type="text" name="language" id="language"
                        value="{{old('language') ?? $book->language ?? 'English'}}" placeholder="john@example.com"
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                    @error('language')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
                <section class="sm:mb-4 w-full">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="authors">
                        Authors
                    </label>
                    <select name="authors[]" id="authors" multiple
                        class="w-full py-2 px-4 border text-sm  font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                        @foreach ($authors as $author)
                        <option value="{{$author->id}}" {{$book_authors->contains($author->id) ? 'selected' : null}}>
                            {{$author->name}}</option>
                        @endforeach
                    </select>
                    @error('authors')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </section>
            </div>
            <section class="mb-4 text-center">
                <button
                    class="w-full bg-blue-500 active:bg-blue-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                    type="submit">
                    Update Book
                </button>
            </section>
            @csrf
            @method('PUT')
        </form>
    </div>
</div>
@endsection