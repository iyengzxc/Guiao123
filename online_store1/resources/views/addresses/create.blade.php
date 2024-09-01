<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        <div>
                            <label for="address_line_1">Address Line 1</label>
                            <input type="text" name="address_line_1" id="address_line_1" required>
                        </div>
                        
                        <div>
                            <label for="address_line_2">Address Line 2</label>
                            <input type="text" name="address_line_2" id="address_line_2">
                        </div>

                        <div>
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" required>
                        </div>

                        <div>
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" required>
                        </div>

                        <div>
                            <label for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" id="postal_code" required>
                        </div>

                        <div>
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
