<x-app-layout>
    <x-content>
        <div class="flex justify-end mb-8">
            <a type="button" class="btn btn-primary" href="{{ route('menu.create') }}">Add New Item</a>
        </div>
        <div class="grid grid-cols-2">
            @foreach ($menuItems as $menu)
                <div
                    class="flex justify-between border border-neutral/50 hover:border-neutral hover:bg-neutral/50 hover:shadow-lg p-4">
                    <div class="flex gap-4">
                        <figure class="m-0">
                            <img src="{{ $menu->imagePath }}" alt="Shoes" class="h-32 w-40 rounded-lg" />
                        </figure>
                        <div>
                            <h4>{{ $menu->name }}</h4>
                            <p>$RM {{ $menu->price }}</p>
                            <div class="badge badge-primary badge-outline mt-8">{{ $menu->category }}</div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a type="btn" href="{{ route('menu.edit', $menu->id) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </x-content>
</x-app-layout>
