<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>Order #{{ $order->id }}</h3>
                    <p>Status: {{ $order->status }}</p>
                    <p>Total: ${{ $order->total }}</p>

                    <h4>Items:</h4>
                    <ul>
                        @foreach($order->orderItems as $item)
                            <li>{{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
