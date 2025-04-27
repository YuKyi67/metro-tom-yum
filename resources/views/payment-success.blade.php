<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            ✅ Payment Successful!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8 text-center">
                <img src="{{ asset('images/Icon/success.gif') }}" class="w-32 mx-auto mb-4" alt="Success">
                <h3 class="text-2xl font-bold text-green-600">Thank you for your order!</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Your payment has been received. Our team is preparing your order.</p>
                <a href="{{ route('orders.history') }}" class="btn btn-primary mt-4">View My Orders</a>
            </div>
        </div>
    </div>
</x-app-layout>
