<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laralib | @yield('title',config('app.name'))</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div id="app" class="bg-gray-300">
        @include('includes.navbar')

        <main class="py-4">
            @yield('content')
            <flash message="{{session('flash')}}"></flash>
        </main>
        <footer class="mx-auto py-3 text-center bg-gray-800 text-white">
            <p>Developed By <a href="https://wa.me/message/DU2KJXPQO6XZL1">Shakil Alam</a></p>
            <p>&copy 2020 All rights reserved.</p>
        </footer>
        <a href="https://wa.me/+918076688419"
            class="fixed bottom-0 right-0 bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs">Buy
            Now</a>
    </div>
</body>

</html>