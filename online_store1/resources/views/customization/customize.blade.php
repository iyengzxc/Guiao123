<!-- resources/views/customize.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customize Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('cart.save.customization') }}" method="POST" id="customizationForm">
                        @csrf

                        <!-- Choose Customization Type -->
                        <div class="mb-4">
                            <label for="customizationType" class="block text-gray-700">Choose Customization Type</label>
                            <select name="customizationType" id="customizationType" class="border rounded-lg px-4 py-2 w-full" onchange="toggleCustomizationOptions()">
                                <option value="existing">Customize Existing Product</option>
                                <option value="scratch">Make from Scratch</option>
                            </select>
                        </div>

                        <!-- Base Product Information (shown only if customizing existing product) -->
                        <div id="existingProductOptions" class="mb-4">
                            <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                            <p class="text-gray-600">{{ $product->description }}</p>
                            <p class="text-gray-800 font-semibold">Base Price: ₱<span id="basePrice">{{ $product->price }}</span></p>

                            <!-- Material Selection for Existing Product -->
                            <div class="mb-4">
                                <label for="existingMaterial" class="block text-gray-700">Material</label>
                                <select name="existingMaterial" id="existingMaterial" class="border rounded-lg px-4 py-2 w-full" onchange="calculatePrice()">
                                    <option value="0">Select Material</option>
                                    <option value="500">Wood (+₱500)</option>
                                    <option value="800">Metal (+₱800)</option>
                                    <option value="700">Leather (+₱700)</option>
                                </select>
                            </div>

                            <!-- Foam Thickness for Sofa -->
                            <div id="existingFoamThickness" class="mb-4 hidden">
                                <label for="existingFoam" class="block text-gray-700">Foam Thickness (cm)</label>
                                <input type="number" name="existingFoam" id="existingFoam" class="border rounded-lg px-4 py-2 w-full" placeholder="Thickness in cm" oninput="calculatePrice()" />
                            </div>
                        </div>

                        <!-- Product Type Selection for Scratch -->
                        <div id="scratchOptions" class="mb-4 hidden">
                            <label for="productType" class="block text-gray-700">Product Type</label>
                            <select name="productType" id="productType" class="border rounded-lg px-4 py-2 w-full" onchange="toggleProductTypeOptions()">
                                <option value="0">Select Product Type</option>
                                <option value="table">Table</option>
                                <option value="chair">Chair</option>
                                <option value="sofa">Sofa</option>
                            </select>

                            <!-- Material Selection for Scratch -->
                            <div class="mb-4">
                                <label for="scratchMaterial" class="block text-gray-700">Material</label>
                                <select name="scratchMaterial" id="scratchMaterial" class="border rounded-lg px-4 py-2 w-full" onchange="calculatePrice()">
                                    <!-- Options will be dynamically populated based on product type -->
                                </select>
                            </div>

                            <!-- Foam Thickness for Sofa -->
                            <div id="scratchFoamThickness" class="mb-4 hidden">
                                <label for="scratchFoam" class="block text-gray-700">Foam Thickness (cm)</label>
                                <input type="number" name="scratchFoam" id="scratchFoam" class="border rounded-lg px-4 py-2 w-full" placeholder="Thickness in cm" oninput="calculatePrice()" />
                            </div>
                        </div>

                        <!-- Size Selection -->
                        <div class="mb-4">
                            <label for="size" class="block text-gray-700">Size (L x W x H)</label>
                            <div class="flex space-x-2">
                                <input type="number" name="length" id="length" class="border rounded-lg px-4 py-2 w-1/3" placeholder="Length" oninput="calculatePrice()" />
                                <input type="number" name="width" id="width" class="border rounded-lg px-4 py-2 w-1/3" placeholder="Width" oninput="calculatePrice()" />
                                <input type="number" name="height" id="height" class="border rounded-lg px-4 py-2 w-1/3" placeholder="Height" oninput="calculatePrice()" />
                            </div>
                            <select name="unit" id="unit" class="border rounded-lg px-4 py-2 w-full mt-2" onchange="calculatePrice()">
                                <option value="cm">cm</option>
                                <option value="inch">inch</option>
                                <option value="meter">meter</option>
                            </select>
                        </div>

                        <!-- Color Selection with Indicator -->
                        <div class="mb-4">
                            <label for="color" class="block text-gray-700">Color</label>
                            <div class="flex items-center space-x-2">
                                <select name="color" id="color" class="border rounded-lg px-4 py-2 w-full" onchange="calculatePrice()">
                                    <option value="0">Select Color</option>
                                    <option value="blue">Blue</option>
                                    <option value="red">Red</option>
                                    <option value="white">White</option>
                                    <option value="black">Black</option>
                                    <option value="gray">Gray</option>
                                </select>
                                <span id="colorIndicator" class="w-6 h-6 rounded-full"></span>
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="mb-4">
                            <p class="text-lg font-bold">Total Price: ₱<span id="totalPrice">{{ $product->price }}</span></p>
                        </div>

                        <!-- Save Customization Button -->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Save Customization</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const materialOptions = {
            table: [
                { value: 500, text: 'Wood (+₱500)' },
                { value: 800, text: 'Metal (+₱800)' }
            ],
            chair: [
                { value: 500, text: 'Wood (+₱500)' },
                { value: 800, text: 'Metal (+₱800)' }
            ],
            sofa: [
                { value: 700, text: 'Leather (+₱700)' },
                { value: 900, text: 'Silk (+₱900)' }
            ]
        };

        function toggleCustomizationOptions() {
            const customizationType = document.getElementById('customizationType').value;
            const existingProductOptions = document.getElementById('existingProductOptions');
            const scratchOptions = document.getElementById('scratchOptions');

            if (customizationType === 'existing') {
                existingProductOptions.classList.remove('hidden');
                scratchOptions.classList.add('hidden');
            } else {
                existingProductOptions.classList.add('hidden');
                scratchOptions.classList.remove('hidden');
            }

            calculatePrice();
        }

        function toggleProductTypeOptions() {
            const productType = document.getElementById('productType').value;
            const scratchMaterial = document.getElementById('scratchMaterial');
            const scratchFoamThickness = document.getElementById('scratchFoamThickness');

            // Clear previous options
            scratchMaterial.innerHTML = '';

            // Populate material options based on product type
            materialOptions[productType].forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                scratchMaterial.appendChild(opt);
            });

            // Show or hide foam thickness option for sofa
            if (productType === 'sofa') {
                scratchFoamThickness.classList.remove('hidden');
            } else {
                scratchFoamThickness.classList.add('hidden');
            }

            calculatePrice();
        }

        function calculatePrice() {
            const basePrice = parseFloat(document.getElementById('basePrice').textContent || 0);
            const sizePrice = parseFloat(document.getElementById('size').value || 0);
            const existingMaterialPrice = parseFloat(document.getElementById('existingMaterial').value || 0);
            const scratchMaterialPrice = parseFloat(document.getElementById('scratchMaterial').value || 0);
            const length = parseFloat(document.getElementById('length').value || 0);
            const width = parseFloat(document.getElementById('width').value || 0);
            const height = parseFloat(document.getElementById('height').value || 0);
            const unit = document.getElementById('unit').value || 'cm';
            const color = document.getElementById('color').value || '0'; // Default to '0' if no color selected
            const existingFoamPrice = parseFloat(document.getElementById('existingFoam').value || 0);
            const scratchFoamPrice = parseFloat(document.getElementById('scratchFoam').value || 0);

            let colorPrice = 0;

            // Assign price based on selected color
            switch (color) {
                case 'blue':
                    colorPrice = 50; // Adjust price based on your pricing strategy
                    break;
                case 'red':
                    colorPrice = 60; // Adjust price based on your pricing strategy
                    break;
                case 'white':
                    colorPrice = 40; // Adjust price based on your pricing strategy
                    break;
                case 'black':
                    colorPrice = 70; // Adjust price based on your pricing strategy
                    break;
                case 'gray':
                    colorPrice = 55; // Adjust price based on your pricing strategy
                    break;
                default:
                    colorPrice = 0; // No color selected
                    break;
            }

            let sizeMultiplier = 1;

            if (unit === 'inch') {
                sizeMultiplier = 2.54;
            } else if (unit === 'meter') {
                sizeMultiplier = 100;
            }

            const totalSize = length * width * height * sizeMultiplier;
            const totalPrice = basePrice + sizePrice + existingMaterialPrice + scratchMaterialPrice + totalSize + colorPrice + existingFoamPrice + scratchFoamPrice;

            document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);

            // Update color indicator
            const colorIndicator = document.getElementById('colorIndicator');
            if (color !== '0') {
                colorIndicator.style.background = color;
                colorIndicator.style.display = 'inline-block';
            } else {
                colorIndicator.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            calculatePrice();
        });
    </script>
</x-app-layout>
