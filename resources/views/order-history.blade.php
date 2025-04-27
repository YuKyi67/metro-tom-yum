<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Order History
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($orders->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-400">You have no past orders.</p>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        @php
                            $items = json_decode($order->items, true);
                            $grandTotal = 0;
                            $status = $order->status;

                            $statusStyle = [
                                'Completed' => 'bg-green-100 text-green-700',
                                'Canceled' => 'bg-red-100 text-red-700',
                                'Cancelled' => 'bg-red-100 text-red-700',
                                'Pending' => 'bg-yellow-100 text-yellow-700',
                                'Order Accepted & Getting Ready' => 'bg-blue-100 text-blue-700',
                                'Ready for Pickup' => 'bg-green-200 text-green-800'
                            ][$status] ?? 'bg-gray-100 text-gray-700';

                            $statusIcon = [
                                'Completed' => '✅',
                                'Canceled' => '❌',
                                'Cancelled' => '❌',
                                'Pending' => '⏳',
                                'Order Accepted & Getting Ready' => '👨‍🍳',
                                'Ready for Pickup' => '📦'
                            ][$status] ?? '❔';
                        @endphp

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                            <div class="flex justify-between items-center mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Order #{{ $order->id }}</h3>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusStyle }}">
                                    {{ $statusIcon }} {{ $status }}
                                </span>
                            </div>

                            @if (is_array($items))
                                @foreach ($items as $item)
                                    @php $itemTotal = $item['quantity'] * $item['price']; @endphp
                                    <div class="flex items-center gap-4 border-b border-gray-200 py-3">
                                        <img src="{{ Storage::url($item['imagePath']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg shadow">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 dark:text-white">{{ $item['name'] }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">Qty: {{ $item['quantity'] }} × RM{{ number_format($item['price'], 2) }}</p>
                                        </div>
                                        <div class="text-right font-medium text-gray-700 dark:text-gray-100">
                                            RM{{ number_format($itemTotal, 2) }}
                                        </div>
                                    </div>
                                    @php $grandTotal += $itemTotal; @endphp
                                @endforeach
                            @endif

                            <div class="text-right mt-4 font-bold text-indigo-600 dark:text-indigo-400">
                                Grand Total: RM{{ number_format($grandTotal, 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
