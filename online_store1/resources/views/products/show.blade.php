<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="card-img-top w-100 h-auto object-cover border rounded-lg mb-4">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title text-2xl font-semibold mb-2">{{ $product->name }}</h3>
                            <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                            <p class="card-text text-lg font-semibold"><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>

                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center mb-3">
                                @csrf
                                <label for="quantity" class="sr-only">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" required class="form-control border rounded-lg px-4 py-2 w-25 me-2">
                                <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
                            </form>

                            <a href="{{ route('checkout.immediate', $product->id) }}" class="btn btn-success btn-lg me-2">Buy Now</a>
                            <a href="{{ route('customization.customize', $product->id) }}" class="btn btn-secondary btn-lg">Customize Product</a>
                        </div>
                    </div>

                    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary btn-lg mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .btn {
        cursor: pointer;
    }
</style>
