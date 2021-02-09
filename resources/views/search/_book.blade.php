<div
    class="w-full flex flex-col sm:flex-row items-center justify-between rounded-lg mb-3 p-4 border bg-gray-800 text-gray-100">
    {{-- <img src="{{$user->profile->image}}" alt="Profile picture of {{$user->username}}"
    class="rounded-full h-24 w-24 border mr-2"> --}}
    <div class="flex flex-col">
        <h3 class="text-xl font-semibold">{{$book->title}}</h3>
        <div>
            @foreach ($book->authors as $author)
            <a href="{{route('authors.show',$author)}}" class="text-gray-300">{{$author->name}}@if ($loop->remaining),
                @endif </a>
            @endforeach
        </div>
        <x-book-average-rating average-rating="{{$book->average_rating}}"></x-book-average-rating>
    </div>
    <a href="{{route('books.show',$book)}}"
        class="w-full sm:w-24 text-center bg-indigo-600 text-gray-100 py-1 px-2 rounded outline-none focus:outline-none mt-2 uppercase shadow hover:shadow-md font-bold text-xs">View
        Book</a>
</div>
