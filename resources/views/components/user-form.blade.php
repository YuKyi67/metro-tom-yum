@props([
    'route' => 'register',
    'title' => 'Register',
])

<form method="POST" action="{{ route($route) }}">
    @csrf
    <div
        class="prose w-full mx-auto space-y-6 mt-8 sm:px-6 lg:px-8 sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <!-- Name -->
        <h1>{{ $title }}</h1>
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- User Role -->
        @if ($route === 'users.store')
            <div>
                <x-input-label for="role" :value="__('Select User Role')" />
                <div class="space-x-4 flex">
                    <div>
                        <input type="radio" id="user" name="role" value="user" checked>
                        <label for="user">User</label>
                    </div>
                    <div>
                        <input type="radio" id="admin" name="role" value="admin">
                        <label for="admin">Admin</label>
                    </div>
                    <div>
                        <input type="radio" id="staff" name="role" value="staff">
                        <label for="staff">Staff</label>
                    </div>
                </div>
            </div>
        @endif

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button>
            Submit
        </x-primary-button>
    </div>
</form>
