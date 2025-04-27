<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tom Tom') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-base-100 min-h-screen">
    <header x-data="{open: false}" class="bg-primary/20 dark:bg-neutral shadow-2xl">
        <div class="border-b border-primary/10 dark:border-gray-700 p-2">
            <p class="container max-w-7xl mx-auto font-semibold text-sm">Welcome to Metro Tomyam</p>
        </div>
        <nav class="container max-w-7xl mx-auto navbar py-6">
            <div class="navbar-start">
                {{-- Mobile --}}
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden px-0">
                        <x-application-logo class="h-12 w-auto" />
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 dark:bg-gray-800 rounded-box z-[1] mt-3 w-52 p-2 shadow border border-gray-400">
                        <li>
                            <x-nav-link class="py-2" :href="'/'" :active="request()->is('/')">
                                {{ __('Home') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="py-2" :href="'/about'" :active="request()->is('about')">
                                {{ __('About Us') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="py-2" :href="'/contact'" :active="request()->is('contact')">
                                {{ __('Contact Us') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </div>
                <a href="/"><x-application-logo class="h-12 w-auto hidden lg:block" /></a>
            </div>
            <div class="navbar-center hidden space-x-4 sm:flex items-center">
                <x-nav-link class="py-2" :href="'/'" :active="request()->is('/')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link class="py-2" :href="'/about'" :active="request()->is('about')">
                    {{ __('About Us') }}
                </x-nav-link>
                <x-nav-link class="py-2" href="{{ url('contact') }}" :active="request()->is('contact')">
                    {{ __('Contact Us') }}
                </x-nav-link>
            </div>
            <div class="navbar-end">
                @if (Route::has('login'))
                    <nav class="flex justify-between items-center">
                        <div>
                            @auth
                                {{-- <a type="button" class="btn btn-ghost" href="{{ url('dashboard') }}">Dashboard</a> --}}
                                @if (Auth::user()->role == 'user')
                                <x-customer-nav />
                                    
                                @else
                                <a type="button" class="btn btn-ghost" href="{{ route('dashboard') }}">Dashboard</a>
                                @endif
                            @else
                                <div class="hidden sm:flex">
                                    <a type="button" class="btn btn-ghost" href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a type="button" class="btn btn-outline" href="{{ route('register') }}">Register</a>
                                @endif
                                </div>
                            @endauth
                        </div>
                    </nav>
                @endif

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link class="py-2" :href="'/'" :active="request()->is('/')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link class="py-2" :href="'/about'" :active="request()->is('about')">
                    {{ __('About Us') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link class="py-2" href="{{ url('contact') }}" :active="request()->is('contact')">
                    {{ __('Contact Us') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit', Auth::user()->id)">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
                @endauth

                @guest
                    <!-- If the user is logged out, you can display login/signup links here -->
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endguest
            </div>
        </div>
    </header>

    <main class="space-y-32 pb-32">
        {{ $slot }}
    </main>

</body>
<x-footer />

</html>
