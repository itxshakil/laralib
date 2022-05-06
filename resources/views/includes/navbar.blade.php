<nav class="bg-gray-800">
    <div class=" sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                    aria-label="Main menu" aria-expanded="false">
                    <!-- Icon when menu is closed. -->
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg v-if="isOpen == false" @click="isOpen = true" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg v-else @click="isOpen = false" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center pl-4 md:pl-0  justify-start">
                <a class="flex-shrink-0 text-white uppercase font-bold tracking-wider" href="/">{{ config('app.name', 'Laravel') }}</a>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex">
                        @auth
                        <a href="{{route('home')}}"
                            class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'home' ? 'bg-gray-900' : null}}">Dashboard</a>
                        @endauth
                        <a href="{{route('books.index')}}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'books.index' ? 'bg-gray-900' : null}}">Books</a>
                        @auth
                        <a href="{{route('issues.index')}}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'issues.index' ? 'bg-gray-900' : null}}">My
                            Issue History</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <form action="{{route('search')}}" method="get">
                    <input type="search" name="q" id="q" placeholder="Search Books" value="{{request()->input('q')}}"
                        class="w-48 sm:w-64 my-2 py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
                </form>
                <button
                    class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                    aria-label="Notifications">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- Profile dropdown -->
                <div class="ml-3 relative">
                    @auth
                    <div>
                        <button @click="isOpen = !isOpen"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out"
                            id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{Auth::user()->name}}&color=FFFFFF&background=111827" alt="Avatar of {{Auth::user()->name}}">
                        </button>
                    </div>
                    <!--
                        Profile dropdown panel, show/hide based on dropdown state.
                        Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                        Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                        <div :class="isOpen ? 'sm:block' : 'hidden'" class="py-1 rounded-md bg-white shadow-xs"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="{{route('password.change')}}"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                role="menuitem">Change Password</a>
                            <a href="{{route('issues.index')}}"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                role="menuitem">My Issue History</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                role="menuitem"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                                out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}"
                        class="bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!--
        Mobile menu, toggle classes based on menu state.

        Menu open: "block", Menu closed: "hidden"
    -->
    <div :class="isOpen ? 'block' : 'hidden'" class="sm:hidden">
        <div class="px-2 pt-2 pb-3">
            @auth
            <a href="{{route('home')}}"
                class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                {{Route::currentRouteName() == 'home' ? 'bg-gray-900' : null}}>Dashboard</a>
            @endauth
            <a href="{{route('books.index')}}"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                {{Route::currentRouteName() == 'books.index' ? 'bg-gray-900' : null}}>Books</a>
            @auth
            <a href="{{route('issues.index')}}"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'issues.index' ? 'bg-gray-900' : null}}">My
                Issue History</a>
            @endauth
        </div>
    </div>
</nav>