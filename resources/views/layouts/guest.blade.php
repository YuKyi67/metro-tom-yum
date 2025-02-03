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
    <header class="bg-primary/20 dark:bg-neutral shadow-2xl">
        <div class="border-b border-primary/10 dark:border-gray-700 p-2">
            <p class="container mx-auto font-semibold text-sm">Welcome to Metro</p>
        </div>
        <nav class="container mx-auto navbar py-6">
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
            <div class="navbar-center hidden space-x-4 lg:flex items-center">
                <x-nav-link class="py-2" :href="'/'" :active="request()->is('/')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link class="py-2" :href="'/about'" :active="request()->is('about')">
                    {{ __('About Us') }}
                </x-nav-link>
                <x-nav-link class="py-2" :href="'/contact'" :active="request()->is('contact')">
                    {{ __('Contact Us') }}
                </x-nav-link>
            </div>
            <div class="navbar-end">
                @if (Route::has('login'))
                    <nav class="flex justify-between items-center">
                        <div>
                            @auth
                                <a type="button" class="btn btn-ghost" href="{{ url('dashboard') }}">Dashboard</a>
                            @else
                                <a type="button" class="btn btn-ghost" href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a type="button" class="btn btn-outline" href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    </nav>
                @endif
            </div>
        </nav>
    </header>

    <main class="space-y-32 pb-32">
        {{ $slot }}
    </main>

    {{-- <footer class="border-t text-center py-4 border-accent dark:border-gray-700">
        Tom Tom v1.0
    </footer> --}}
</body>

</html>