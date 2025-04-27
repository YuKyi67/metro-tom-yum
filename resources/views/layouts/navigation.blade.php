<nav x-data="{ open: false }" 
     class="{{ Auth::user()->role === 'admin' ? 'bg-[#d9fdff]' : 'bg-[#fbffd0]' }} text-black shadow-lg rounded-b-2xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo & Navigation -->
            <div class="flex items-center space-x-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-black" />
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:flex">
                    <x-nav-link :href="route('dashboard')" 
                                :active="request()->routeIs('dashboard')"
                                class="px-4 py-2 flex justify-center items-center text-center transition-all rounded-lg border-b-4 border-transparent
                                       {{ request()->routeIs('dashboard') ? 'bg-white text-black shadow-lg' : 'hover:border-gray-300' }}">
                        <i class="fas fa-home"></i> 
                        <span>Dashboard</span>
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" 
                                :active="request()->routeIs('users.index')"
                                class="px-4 py-2 flex justify-center items-center text-center transition-all rounded-lg border-b-4 border-transparent
                                       {{ request()->routeIs('users.index') ? 'bg-white text-black shadow-lg' : 'hover:border-gray-300' }}">
                        <i class="fas fa-users"></i> 
                        <span>Users</span>
                    </x-nav-link>

                    <x-nav-link :href="route('contact-us.feedback')" 
                                :active="request()->routeIs('contact-us.feedback')"
                                class="px-4 py-2 flex justify-center items-center text-center transition-all rounded-lg border-b-4 border-transparent
                                       {{ request()->routeIs('contact-us.feedback') ? 'bg-white text-black shadow-lg' : 'hover:border-gray-300' }}">
                        <i class="fas fa-comments"></i> 
                        <span>Feedback</span>
                    </x-nav-link>

                    <x-nav-link :href="route('menu.index')" 
                                :active="request()->routeIs('menu.index')"
                                class="px-4 py-2 flex justify-center items-center text-center transition-all rounded-lg border-b-4 border-transparent
                                       {{ request()->routeIs('menu.index') ? 'bg-white text-black shadow-lg' : 'hover:border-gray-300' }}">
                        <i class="fas fa-bars"></i> 
                        <span>Menu</span>
                    </x-nav-link>

                    <x-nav-link :href="route('orders.all')" 
                                :active="request()->routeIs('orders.all')"
                                class="px-4 py-2 flex justify-center items-center text-center transition-all rounded-lg border-b-4 border-transparent
                                        {{ request()->routeIs('orders.all') ? 'bg-white text-black shadow-lg' : 'hover:border-gray-300' }}">
                        <i class="fas fa-box"></i>
                        <span class="ml-2">View Orders</span>
                    </x-nav-link>
                </div>
            </div>

             <!-- Settings Dropdown -->
             <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile Link -->
                        <x-dropdown-link :href="route('profile.edit', Auth::user()->id)">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" 
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
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
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- based on the defined policy --}}
            @can('viewAny', App\Models\User::class)
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">{{ __('Users') }}</x-nav-link>
                <x-responsive-nav-link :href="route('contact-us.feedback')" :active="request()->routeIs('contact-us.feedback')">{{ __('Feedbacks') }}</x-nav-link>
            @endcan

            <x-responsive-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')">{{ __('Menu') }}</x-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
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
        </div>
    </div>
</nav>
