<div class="grid grid-cols-2">
    @foreach ($menuItems as $item)
        <div
            class="flex justify-between border border-neutral/50 hover:border-neutral hover:bg-neutral/50 hover:shadow-lg p-4">
            <div class="flex gap-4">
                <figure class="m-0">
                    <img src="{{ $item->imagePath }}" alt="Shoes" class="h-32 w-40 rounded-lg" />
                </figure>
                <div class="flex flex-col justify-between">
                    <div>
                        <h4>{{ $item->name }}</h4>
                        <p>$RM {{ $item->price }}</p>
                    </div>
                    <div class="badge badge-primary badge-outline mt-8">{{ $item->category }}</div>
                </div>
            </div>
            @if ((Auth::check() && Auth::user()->role !== 'admin') || Auth::guest())
                <button class="btn btn-primary btn-sm">Add To Cart</button>
            @else
                <div class="flex flex-col gap-2">
                    <a type="btn" href="{{ route('menu.edit', $item->id) }}" class="btn btn-outline btn-sm">Edit</a>
                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
</div>
