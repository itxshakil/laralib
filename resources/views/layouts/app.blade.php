<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRXIYL6yenkxhE2G4UhEjBQarn6Sb3Z3jRtBdBCoAWA" />
    <meta name="description"
        content="Laralib is a Library Management System with Admin and User Authentication system, where you can manage users (students), books, author, and issue logs. It also has an automatic fine calculation for the late returned book." />
    <meta name="keywords"
        content="library management system,laravel library management system,laravel library management system with admin panel,laravel,admin panel,laravel project,laravel 8,library management system in laravel" />
    <meta name="subject" content="Laravel Library Management | Laralib" />
    <meta name="language" content="en" />
    <meta name="rating" content="General" />
    <meta name="url" content="https://laralib.herokuapp.com" />
    <meta name="identifier-URL" content="https://laralib.herokuapp.com" />
    <meta name="owner" content="Shakil Alam" />
    <meta name="author" content="Shakil Alam , itxshakil@gmail.com" />
    <meta name="og:title" content="Portfolio" />
    <meta name="og:url" content="https://laralib.herokuapp.com" />
    <meta name="og:url" content="https://laralib.herokuapp.com" />
    <meta name="og:url" content="https://laralib.herokuapp.com/" />
    <meta name="og:site_name" content="Shakil Alam | Portfolio" />
    <meta name="og:description"
        content="Laralib is a Library Management System with Admin and User Authentication system, where you can manage users (students), books, author, and issue logs. It also has an automatic fine calculation for the late returned book." />
    <meta name="og:email" content="itxshakil@gamil.com" />
    <meta name="og:country-name" content="India" />

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
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-T2TRW59');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T2TRW59" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="app" class="bg-gray-300 min-h-screen flex flex-col justify-between">
        @include('includes.navbar')

        <main class="py-4">
            @yield('content')
            <flash message="{{session('flash')}}"></flash>
        </main>
        <footer class="mx-auto py-3 text-center bg-gray-800 text-white">
            <p>Developed By <a href="https://shakiltech.com">Shakil Alam</a></p>
            <p>&copy; 2022 All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
