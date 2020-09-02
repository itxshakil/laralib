@extends('layouts.admin.app')
@section('title','Change Password')
@section('content')
<div class="container mx-auto flex justify-center px-3 md:px-6 my-12">
    <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg_cover rationounded-l-lg"
            style="background-image: url('https://source.unsplash.com/K4mSJ7kc0As/600x800')">
        </div>
        <div class="w-full lg:w-1/2 bg-gray-100 p-2 md:p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">{{ __('Change Password') }}</h3>
            <form class="px-4 md:px-8  pt-6 pb-2 mb-4 bg-white rounded" method="POST"
                action="{{ route('admin.password.change.submit') }}">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="current-password">
                        {{ __('Current Password') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('email') border-red-500 @enderror"
                        id="current-password" type="password" placeholder="**********" name="current-password"
                        autocomplete="current-password" required autofocus />
                    @error('current-password')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                        {{ __('New Password') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border  rounded shadow appearance-none focus:outline-none @error('password') border-red-500 @enderror"
                        id="password" type="password" name="password" autocomplete="new-password"
                        value="{{old('password')}}" placeholder="******************" required />
                    @error('password')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
                        {{ __('Confirm New Password') }}
                    </label>
                    <input
                        class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border  rounded shadow appearance-none focus:outline-none @error('password_confirmation') border-red-500 @enderror"
                        id="password_confirmation" type="password" autocomplete="new-password"
                        name="password_confirmation" placeholder="******************" required />
                    @error('password_confirmation')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 text-center">
                    <button
                        class="w-full px-4 py-2 font-bold text-white bg-indigo-500 rounded-lg hover:bg-indigo-700 focus:outline-none"
                        type="submit">
                        {{ __('Change Password') }}
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection