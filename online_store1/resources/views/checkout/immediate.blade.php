<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout im') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Immediate Checkout") }}
                    
                    <div class="mt-6">
                        <div class="border rounded-lg p-4 bg-white">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-28 h-35 object-cover">
                            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                            <p class="text-gray-600">{{ $product->description }}</p>
                            <p class="text-gray-800 font-semibold">₱{{ number_format($product->price) }}</p>
                            
                            <div class="mt-4">
                                <form action="{{ route('order.show', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
