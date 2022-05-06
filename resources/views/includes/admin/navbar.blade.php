<nav class="bg-gray-800">
    <div class="sm:px-6 lg:px-8">
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
            <div class="flex-1 flex items-center pl-4 md:pl-0 justify-start">
                <a class="flex-shrink-0 text-white uppercase font-bold tracking-wider" href="/">{{ config('app.name', 'Laravel') }}</a>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex">
                        <a href="{{route('admin.dashboard')}}"
                            class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-900' : null}}">Dashboard</a>
                        <a href="{{route('admin.users.index')}}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'admin.users.index' ? 'bg-gray-900' : null}}">Users</a>
                        <a href="{{route('admin.books.index')}}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'admin.books.index' ? 'bg-gray-900' : null}}">Books</a>
                        <a href="{{route('admin.authors.index')}}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'admin.authors.index' ? 'bg-gray-900' : null}}">Authors</a>
                        <a href="{{route('admin.request.books')}}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{Route::currentRouteName() == 'admin.request.books' ? 'bg-gray-900' : null}}">Requests</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a href="{{route('admin.issue_logs.create')}}"
                    class="flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">Issue
                    Book</a>
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
                    <div>
                        <button @click="isOpen = !isOpen"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out"
                            id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{Auth::user()->name}}&color=FFFFFF&background=111827" alt="Avatar of {{Auth::user()->name}}" />
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
                        <div :class="isOpen ? 'hidden sm:block' : 'hidden'" class="py-1 rounded-md bg-white shadow-xs"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="#"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                role="menuitem">Your Profile</a>
                            <a href="/admin/password/change"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                role="menuitem">Change Password</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                role="menuitem" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    Mobile menu, toggle classes based on menu state.
 z
    Menu open: "block", Menu closed: "hidden"
  -->
    <div :class="isOpen ? 'block' : 'hidden'" class="sm:hidden">
        <div class="px-2 pt-2 pb-3">
            <a href="{{route('admin.dashboard')}}"
                class="block px-3 py-2 rounded-md text-base font-medium {{Route::currentRouteName() == 'admin.dashboard' ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white'}} focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Dashboard</a>
            <a href="{{route('admin.users.index')}}"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium {{Route::currentRouteName() == 'admin.users.index' ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white'}} hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Users</a>
            <a href="{{route('admin.books.index')}}"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium  {{Route::currentRouteName() == 'admin.books.index' ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white'}} hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Books</a>
            <a href="{{route('admin.authors.index')}}"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium  {{Route::currentRouteName() == 'admin.authors.index' ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white'}} hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Authors</a>
            <a href="{{route('admin.request.books')}}"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium  {{Route::currentRouteName() == 'admin.request.books' ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white'}} hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Requests</a>
        </div>
    </div>
</nav>