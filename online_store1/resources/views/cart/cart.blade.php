<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($cart->isEmpty())
                        <p>Your cart is empty.</p>
                    @else
                        <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr data-product-id="{{ $item->product_id }}">
                                            <td>
                                                <input type="checkbox" class="product-checkbox" name="selected_products[]" value="{{ $item->product_id }}">
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover">
                                            </td>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="product-price">₱{{ $item->product->price }}</td>
                                            <td>
                                                <div class="flex items-center">
                                                    <button type="button" class="btn btn-secondary quantity-decrease text-xs bg-red-500 text-white px-2 py-1 rounded-l">-</button>
                                                    <input type="number" name="quantities[{{ $item->product_id }}]" value="{{ $item->quantity }}" min="1" class="w-16 text-center border rounded p-1 quantity-input">
                                                    <button type="button" class="btn btn-secondary quantity-increase text-xs bg-green-500 text-white px-2 py-1 rounded-r">+</button>
                                                </div>
                                            </td>
                                            <td class="product-total">₱{{ $item->product->price * $item->quantity }}</td>
                                            <td>
                                                
                                                <form action="{{ route('cart.remove', $item->product_id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Checkout Section -->
                            <div class="flex justify-between items-center mt-4">
                                <!-- Checkbox Total Payment -->
                                <div>
                                    <span>Total Payment:</span>
                                    <span id="total-payment">₱0.00</span>
                                </div>

                                <!-- Checkout Button -->
                                <div>
                                    <button type="submit" class="btn btn-primary" href="{{ route('checkout.index') }}">Checkout</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const quantityIncreases = document.querySelectorAll('.quantity-increase');
            const quantityDecreases = document.querySelectorAll('.quantity-decrease');
            const checkoutForm = document.getElementById('checkout-form');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');

            quantityIncreases.forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.closest('tr').querySelector('.quantity-input');
                    input.value = parseInt(input.value) + 1;
                    updateQuantity(input);
                });
            });

            quantityDecreases.forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.closest('tr').querySelector('.quantity-input');
                    if (input.value > 1) {
                        input.value = parseInt(input.value) - 1;
                        updateQuantity(input);
                    }
                });
            });

            quantityInputs.forEach(input => {
                input.addEventListener('change', function () {
                    updateQuantity(this);
                });
            });

            function updateQuantity(input) {
                const productId = input.closest('tr').dataset.productId;
                const quantity = input.value;
                const price = parseFloat(input.closest('tr').querySelector('.product-price').textContent.replace('₱', ''));

                updateCart(productId, quantity, price);
            }

            function updateCart(productId, quantity, price) {
                fetch('{{ route("cart.update") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantities: {
                            [productId]: quantity
                        }
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                        const total = price * quantity;
                        row.querySelector('.product-total').textContent = '₱' + total.toFixed(2);
                        updateTotalPayment();
                    } else {
                        alert('Failed to update cart');
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            function updateTotalPayment() {
                const checkboxes = document.querySelectorAll('input[name="selected_products[]"]:checked');
                let totalPayment = 0;
                checkboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const productTotal = parseFloat(row.querySelector('.product-total').textContent.replace('₱', ''));
                    totalPayment += productTotal;
                });
                document.getElementById('total-payment').textContent = '₱' + totalPayment.toFixed(2);
            }

            // Update total payment on checkbox change
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    updateTotalPayment();
                });
            });

            // Ensure only selected products are included in the checkout form submission
            checkoutForm.addEventListener('submit', function (event) {
                productCheckboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        checkbox.disabled = true;
                    }
                });
            });
        });
    </script>
</x-app-layout>
