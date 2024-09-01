<!-- resources/views/products/search-results.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">
                    @if($products->isEmpty())
                        <p>No products found matching your search.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                            @foreach ($products as $product)
                                <div class="border rounded-lg p-4 bg-white cursor-pointer" onclick="window.location='{{ route('products.show', $product->id) }}'">
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    <h3 class="text-lg font-bold mt-2">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $product->description }}</p>
                                    <p class="text-gray-800 font-semibold mt-1">₱{{ number_format($product->price) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
