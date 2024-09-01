<!-- resources/views/products/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="bg-gray-100 light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-black-200">Product Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full text-black dark:text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-black-200">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full text-black dark:text-black" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-black-200">Price</label>
                            <input type="text" name="price" id="price" class="mt-1 block w-full text-black dark:text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-black-200">Product Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-black dark:text-black" required>
                        </div>
                        <div class="flex items-center justify-end text-bg-gray">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary ml-3">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
