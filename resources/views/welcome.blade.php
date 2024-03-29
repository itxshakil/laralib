<!DOCTYPE html>
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
    <meta name="og:title" content="Laravel Library Management | Laralib" />
    <meta name="og:url" content="https://laralib.herokuapp.com" />
    <meta name="og:site_name" content="Shakil Alam | Portfolio" />
    <meta name="og:description"
        content="Laralib is a Library Management System with Admin and User Authentication system, where you can manage users (students), books, author, and issue logs. It also has an automatic fine calculation for the late returned book." />
    <meta name="og:email" content="itxshakil@gamil.com" />
    <meta name="og:country-name" content="India" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Laravel Library Management</title>

    <!-- Scripts -->
    {{-- <script src="/js/app.js" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <style>
        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
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
    <div id="app" class="text-gray-800">
        <div class="bg-gray-300 flex items-center justify-center relative">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth('admin')
                <a class="text-white" href="{{ url('/admin') }}">Dashboard</a>
                @else
                <a class="text-white" href="{{ route('admin.login') }}">Admin Login</a>
                @endif
                @auth
                <a class="text-white" href="{{ url('/home') }}">Home</a>
                @else
                <a class="text-white" href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a class="text-white" href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
        <main class="py-4 flex flex-col justify-center items-center h-screen bg-indigo-700 text-white">
            <h1 class="text-6xl text-center">LaraLib</h1>
            <h2 class="text-3xl text-center">A Modern Way of Managing Library</h2>
            <a href="/admin" class="mt-2 bg-indigo-500 active:bg-indigo-800 text-white px-4 sm:px-8 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold">Try now</a>
        </main>
        <section id="features" class="-mt-10 bg-white rounded shadow p-4 container mx-auto border-gray-600">
            <h2 class="text-3xl font-semibold text-center underline">Features</h2>
            <h3 class="text-2xl">Admin Panel</h3>
            <h5 class="ml-4 mb-1">Dashboard (Graphical report of recent activities.</h5>
            <h5 class="ml-4 mb-1">Member Management (Student and course)</h5>
            <h5 class="ml-4 mb-1">Book management(book, authors and categories)</h5>
            <h5 class="ml-4 mb-1">Circulation management (issue, and return)</h5>
            <h5 class="ml-4 mb-1">Automatic fine calculation for late return</h5>
            <h5 class="ml-4 mb-1">Requested Book by members (accept or reject)</h5>
            <h5 class="ml-4 mb-1">Separate Authentication System form Admins (multiple admin)</h5>
            <h5 class="ml-4 mb-1">Change Password</h5>
            <h5 class="ml-4 mb-1">Notify member by SMS and Email (Coming soon)</h5>
            <h5 class="ml-4 mb-1">Book Rating management (approve, block, spam) (Coming Soon)</h5>
            <h3 class="text-2xl mt-4">Member Panel</h3>
            <h5 class="ml-4 mb-1">Browse Books (recent, most issued)</h5>
            <h5 class="ml-4 mb-1">Circulation History</h5>
            <h5 class="ml-4 mb-1">Authentication System</h5>
            <h5 class="ml-4 mb-1">Change Password</h5>
            <h5 class="ml-4 mb-1">Member can rate books.</h5>
            <h5 class="ml-4 mb-1">Notification of Requested Book (approved, rejected)</h5>
            <h5 class="ml-4 mb-1">View Notification From Admin (Coming Soon)</h5>
            <p>and more...</p>
        </section>
        <section id="contact" class="mt-4 container mx-auto w-full lg:w-1/2 bg-gray-200 p-2 md:p-5 rounded-lg">
            <h3 class="pt-4 text-2xl text-center pb-2 md:pb-4">Contact Us</h3>
            @if (session('message'))
            <p class="text-xs italic text-green-500 mb-2">
                {{ session('message') }}
            </p>
            @endif
            <form action="{{route('contact')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">{{ __('Full name') }}</label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('name') border-red-500 @enderror"
                        type="text" id="name" name="name" autocomplete="name" placeholder="John Doe"
                        value="{{old('name')}}" required aria-required="true" />
                    @error('name')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700"
                        for="email">{{ __('E-Mail Address') }}</label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('email') border-red-500 @enderror"
                        type="email" id="email" name="email" autocomplete="email" placeholder="john.doe@example.com"
                        value="{{old('email')}}" required aria-required="true" />
                    @error('email')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700"
                        for="mobile">{{ __('Mobile Number (Optional)') }}</label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('mobile') border-red-500 @enderror"
                        type="number" id="mobile" min="7000000000" max="9999999999" name="mobile" autocomplete="mobile"
                        placeholder="8802559102" title="Enter Valid mobile number" value="{{old('mobile')}}" />
                    @error('mobile')
                    <p class="text-xs italic text-red-500" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <label for="website" class="sr-only hidden">Website (Leave blank)</label>
                <input type="text" id="website" name="website" class="hidden" />
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="message">{{ __('Message') }}</label>
                    <textarea name="message" id="message" cols="30" rows="5"
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none @error('message') border-red-500 @enderror"
                        placeholder="Your message goes here..." required aria-required="true"></textarea>
                </div>
                <div class="mb-4 text-center">
                    <button
                        class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
                        type="submit">Send Now</button>
                </div>
            </form>
        </section>
        <footer id="subscribe" class="py-2 mt-3 bg-gray-800 text-gray-200">
            {{-- <p class="text-3xl text-center">Get it now</p>
            <div class="rounded-full text-center">
                <form action="{{route('contact')}}" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="john@example.net"
                class="w-64 items-center inline-flex outline-none px-4 py-2 rounded-l-full">
            <input type="hidden" name="name" value="Placeholder">
            <input type="hidden" name="message" value="I want it">
            <input type="submit" value="Get it now"
                class="items-center inline-flex outline-none bg-indigo-700 -ml-2 px-4 py-2 rounded-r-full">
            </form>
    </div> --}}

    {{-- <hr class="my-2"> --}}
    <a class="text-center block" href="mailto:itxshakil@gmail.com">itxshakil@gmail.com</a>
    <p class="text-center">All rights reserved &copy;2020</p>
    </footer>
    </div>
</body>

</html>
