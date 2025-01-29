<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-content>
        @foreach ($users as $user)
            {{ $user->name }}
            {{ $user->role }}
        @endforeach
    </x-content>
</x-app-layout>