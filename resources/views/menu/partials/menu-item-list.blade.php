<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    @foreach ($menuItems as $item)
        <div class="flex justify-between border border-neutral-300 dark:border-neutral/50 shadow-sm shadow-neutral/70 rounded-md dark:hover:border-neutral hover:bg-neutral/50 hover:shadow-md p-4">
            <div class="flex gap-4">
                <figure class="m-0">
                    <img src="{{ Storage::url($item->imagePath) }}" alt="{{ $item->name }}" class="h-32 w-40 rounded-lg" />
                </figure>
                <div class="flex flex-col justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">{{ $item->name }}</h4>
                        <p class="text-gray-600">RM {{ number_format($item->price, 2) }}</p>
                    </div>
                    <div class="badge badge-primary badge-outline mt-8">{{ $item->category }}</div>
                </div>
            </div>

            {{-- Admin/Staff actions --}}
            @can(['update', 'delete'], $item)
                <div class="flex flex-col gap-2">
                    <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-outline btn-sm">Edit</a>
                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                    </form>
                </div>
            @else
                @auth
                    <div class="flex flex-col gap-2 justify-end">
                        <label class="text-sm font-medium text-gray-700" for="quantity_{{ $item->id }}">Amount</label>
                        <input 
                            id="quantity_{{ $item->id }}"
                            type="number" 
                            value="1" 
                            min="1"
                            class="quantity-input w-24 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-400" />
                        <button type="button"
                            class="btn btn-primary btn-sm add-to-cart-btn"
                            data-id="{{ $item->id }}">
                            Add To Cart
                        </button>
                    </div>
                @else
                    <div class="text-sm text-red-600 mt-6">
                        🔒 Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to add to cart.
                    </div>
                @endauth
            @endcan
        </div>
    @endforeach
</div>

@once
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.add-to-cart-btn');

        buttons.forEach(button => {
            button.addEventListener('click', async function () {
                const itemId = this.dataset.id;
                const quantityInput = document.getElementById(`quantity_${itemId}`);
                const quantity = quantityInput ? quantityInput.value : 1;

                try {
                    const response = await fetch(`/add-to-cart/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ quantity })
                    });

                    const data = await response.json();

                    if (data.success) {
                        showToast('✅ Item added to cart!');
                    } else {
                        showToast('❌ Failed to add item.');
                    }
                } catch (error) {
                    showToast('⚠️ Error adding item.');
                }
            });
        });

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 bg-green-600 text-white py-3 px-6 rounded shadow-xl text-lg';
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    });
</script>
@endonce
