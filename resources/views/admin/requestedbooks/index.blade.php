@extends('layouts.admin.app')
@section('title','Requested Books')
@section('content')
<div class="container mx-auto">
    <h1 class="font-semibold text-2xl my-2 text-center underline">Requested Books</h1>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Authors</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Publisher</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                            alt />
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="text-sm leading-5 font-medium text-gray-900">{{$book->name}}</h2>
                                        <h3 class="text-sm leading-5 text-gray-500">{{$book->isbn}}</h3>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <h3 class="text-sm leading-5 font-medium text-gray-900">{{$book->author}}</h3>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <p class="text-sm leading-5 font-medium text-gray-900">{{$book->publisher}}</p>
                                <p class="text-sm leading-5 text-gray-500">{{$book->year}}</p>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                @if ($book->status === null)
                                <h4
                                    class="text-sm capitalize inline-block items-center px-2 rounded-full bg-yellow-800 text-yellow-100">
                                    Pending</h4>
                                @else
                                @if ($book->status)
                                <h4
                                    class="text-sm capitalize inline-block items-center px-2 rounded-full bg-green-800 text-green-100">
                                    Approved</h4>
                                @else
                                <h4
                                    class="text-sm capitalize inline-block items-center px-2 rounded-full bg-red-800 text-red-100">
                                    Rejected</h4>
                                @endif
                                @endif

                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <div class="flex flex-col justify-center items-center text-center gap-1">
                                    @if ($book->status === null)
                                    <form action="{{route('admin.request.books.approve',$book)}}" method="post">
                                        @csrf
                                        <input type="submit" value="Approve"
                                            class="w-32 text-sm capitalize py-2 px-4 rounded bg-green-800 text-green-100">
                                    </form>
                                    <form action="{{route('admin.request.books.reject',$book)}}" method="post">
                                        @csrf
                                        <input type="submit" value="Reject"
                                            class="w-32 text-sm capitalize py-2 px-4 rounded bg-red-800 text-red-100">
                                    </form>
                                    @endif
                                    <a href="{{route('admin.request.books.show',$book)}}"
                                        class="w-32 text-sm capitalize py-2 px-4 rounded bg-indigo-800 text-indigo-100">View
                                        Details</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($books->count() > 0)
                {{$books->appends(request()->input())->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
