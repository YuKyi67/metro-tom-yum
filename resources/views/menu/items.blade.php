<x-app-layout>
    <x-content>
        <div class="flex justify-end mb-8">
            <a type="button" class="btn btn-primary" href="{{ route('menu.create') }}">+ Add New Item</a>
        </div>
        @include('menu.partials.menu-item-list')
    </x-content>
</x-app-layout>
