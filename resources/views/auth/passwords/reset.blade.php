@extends('layouts.app')

@section('content')
<div class="container mx-auto flex justify-center px-3 md:px-6">
    <div class="w-full xl:w-3/4 lg:w-11/12 flex my-6">
        <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
            style="background-image: url("https://source.unsplash.com/K4mSJ7kc0As/600x800");background-position-y: center;">
        </div>
        <div class="w-full lg:w-1/2 bg-gray-200 p-2 md:p-5 rounded-r-lg shadow">
            <h1 class="pt-4 text-2xl text-center pb-2 md:pb-4">{{ __('Reset Password') }}</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700"
                        for="email">{{ __('E-Mail Address') }}</label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('email') border-red-500 @enderror"
                        type="email" id="email" value="{{$email ?? old('email')}}" name="email" autocomplete="email"
                        placeholder="john.doe@example.com" required aria-required="true" autofocus />
                    @error('email')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700"
                        for="password">{{ __('Password') }}</label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('password') border-red-500 @enderror"
                        type="password" id="password" name="password" autocomplete="new-password"
                        placeholder="**********" required aria-required="true" />
                    @error('password')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700"
                        for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('password_confirmation') border-red-500 @enderror"
                        type="password" id="password_confirmation" name="password_confirmation"
                        autocomplete="new-password" placeholder="**********" required aria-required="true" />
                    @error('password_confirmation')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 text-center">
                    <button
                        class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                        type="submit">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
