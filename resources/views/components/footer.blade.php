<footer class="border-t flex items-center border-accent dark:border-gray-700">
    <nav class="container max-w-7xl mx-auto navbar">
        <div class="navbar-start">
            <x-nav-link class="py-2" :href="'/'">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link class="py-2" :href="'/about'">
                {{ __('About Us') }}
            </x-nav-link>
            <x-nav-link class="py-2" href="{{ url('contact') }}">
                {{ __('Contact Us') }}
            </x-nav-link>
        </div>
        <div class="navbar-end">
            Metro Tom Yam
        </div>
    </nav>
</footer>