@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl p-2">{{ __($requestedBook->name) }}</h3>
    </div>
    <div class="w-full bg-gray-200 p-2 md:p-5 rounded-lg lg:rounded-l-none">
        <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Details of {{__($requestedBook->name)}}</h3>
        <div class="flex flex-col sm:flex-row gap-2 flex-wrap flex-stretch flex-grow">
            <div class="w-full sm:w-1/2 lg:w-3/12 rounded p-2 border bg-gray-800 text-gray-200">
                <p class="text-xl">{{$requestedBook->name}}</p>
                <p class="mt-2">Written By {{$requestedBook->author}}</p>
                @if ($requestedBook->status)
                <p class="text-sm capitalize inline-block items-center px-2 rounded-full bg-green-800 text-green-100">
                    Approved</p>
                @else
                @if ($requestedBook->status == null)
                <p class="text-sm capitalize inline-block items-center px-2 rounded-full bg-yellow-800 text-yellow-100">
                    Pending</p>
                @else
                <p class="text-sm capitalize inline-block items-center px-2 rounded-full bg-red-800 text-red-100">
                    Rejected</p>
                @endif
                @endif
                <p class="text-gray-500 text-sm">ISBN : {{$requestedBook->isbn}}</p>
                <p class="text-gray-500 text-sm">Publisher : {{$requestedBook->publisher}}</p>
                <p class="text-gray-500 text-sm">Year : {{$requestedBook->year}}</p>
                <p class="text-gray-500 text-sm">Message : {{$requestedBook->message}}</p>
                @if ($requestedBook->user_id)
                <p class="text-gray-500 text-sm">Requested By : {{App\User::find($requestedBook->user_id)->name}}
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection