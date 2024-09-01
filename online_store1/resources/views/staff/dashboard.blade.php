<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Products") }}
                    
                    <!-- Products List -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        @foreach ($products as $product)
                            <div class="border rounded-lg p-4 bg-white">
                            <td><img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-28 h-35 object-cover"></td>
                                <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                                <p class="text-gray-600">{{ $product->description }}</p>
                                <p class="text-gray-800 font-semibold">₱{{ $product->price }}</p>
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Products List -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
