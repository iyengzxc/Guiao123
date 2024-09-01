<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div>
                            <label for="address_id">Select Address</label>
                            <select name="address_id" id="address_id" required>
                                @foreach(Auth::user()->addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->address_line_1 }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>

                    <a href="{{ route('addresses.create') }}" class="btn btn-secondary mt-4">Add New Address</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
