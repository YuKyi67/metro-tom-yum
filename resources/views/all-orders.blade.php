<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            All Customer Orders
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->user_id }}</td>
                            <td class="px-6 py-4">
                                @php $items = json_decode($order->items, true); @endphp
                                @if(is_array($items))
                                    <ul class="ml-4 text-sm text-gray-800 dark:text-gray-200 list-disc">
                                        @foreach($items as $item)
                                            <li>
                                                <strong>{{ $item['name'] }}</strong><br>
                                                Quantity: {{ $item['quantity'] }}<br>
                                                Price: RM {{ $item['price'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-red-500">Invalid item data</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-y-2">
                                @php
                                $status = $order->status;
                                $badge = match($status) {
                                    'Completed' => 'text-green-600 bg-green-100',
                                    'Ready for Pickup' => 'text-green-600 bg-green-200',
                                    'Cancelled' => 'text-red-600 bg-red-100',
                                    'Pending' => 'text-yellow-600 bg-yellow-100',
                                    'Order Accepted & Getting Ready' => 'text-blue-600 bg-blue-100',
                                    default => 'text-gray-600 bg-gray-100'
                                };
                            @endphp
                            

                                <span class="inline-block px-3 py-1 text-sm font-semibold {{ $badge }} rounded-full">
                                    {{ $status }}
                                </span>

                                @if(!in_array($status, ['Completed', 'Cancelled']))
                                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="inline-block mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                            <option value="">Update status</option>
                                            <option value="Order Accepted & Getting Ready">Order Accepted & Getting Ready</option>
                                            <option value="Ready for Pickup">Ready for Pickup</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </form>

                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline-block mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-error">Cancel</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
