<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🛒 My Cart
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                @php
                    $cart = session('cart', []);
                    $total = 0;
                @endphp

                @if (empty($cart))
                    <div class="text-center text-gray-600 dark:text-gray-300">
                        <img src="{{ asset('images/Icon/empty-cart.gif') }}" class="mx-auto w-32 mb-4" alt="Empty Cart">
                        <p>Your cart is feeling empty... 😢</p>
                        <a href="/" class="btn btn-primary mt-4">Browse Menu</a>
                    </div>
                @else
                    <ul class="space-y-6">
                        @foreach ($cart as $id => $item)
                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $total += $itemTotal;
                            @endphp
                            <li class="flex gap-4 bg-base-100 dark:bg-gray-700 rounded-lg shadow p-4 items-center">
                                <img src="{{ Storage::url($item['imagePath']) }}" alt="Item Image" class="w-24 h-24 rounded object-cover border border-gray-300">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Quantity: {{ $item['quantity'] }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Price: RM {{ $item['price'] }} each</p>
                                    <p class="text-sm font-bold text-indigo-600 dark:text-indigo-300">Subtotal: RM {{ $itemTotal }}</p>
                                </div>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-error btn-sm">Remove</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="text-right mt-8 border-t pt-4">
                        <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total: RM {{ $total }}</p>
                        <form method="POST" action="{{ route('cart.checkout') }}">
                            @csrf
                            <button class="btn btn-success mt-4">Checkout Now ✅</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
