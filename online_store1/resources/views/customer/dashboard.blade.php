<x-app-layout>
    <x-slot name="header">
        <!-- Full-width Image -->
        <div class="image-container">
            <img src="{{ asset('imagefront.jpg') }}" class="w-full h-80 object-cover" alt="Carousel Image">
        </div>
    </x-slot>

    <style>
        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05); /* Scale the card on hover */
            z-index: 1;
        }

        .card:hover .card-img-top {
            height: 100%; /* Expand the image height on hover */
        }

        .card-img-top {
            transition: height 0.5s ease;
            overflow: hidden;
            height: 200px; /* Initial height of the card image */
        }

        .card-img-top img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($products as $product)
                            <div class="col mb-4">
                                <div class="card border-0 bg-white rounded-0 shadow-sm">
                                    <div class="card-img-top position-relative overflow-hidden">
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-100 h-100 object-cover" />
                                        </a>
                                        <div class="card-badge">
                                            <span class="badge badge-info">{{ $product->category }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body text-center p-3">
                                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                            <h6 class="card-title mb-2" style="font-size: 1.1rem;">{{ $product->name }}</h6>
                                        </a>
                                        <p class="card-text text-muted mb-3" style="font-size: 0.9rem;">{{ $product->short_description }}</p>
                                        <p class="card-price mb-0 font-weight-bold">₱{{ number_format($product->price) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
