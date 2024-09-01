<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Add New Product Button -->
                    <div class="mb-4">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            Add New Product
                        </a>
                    </div>
                    <!-- Products Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full border" id="products-table">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Image</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Description</th>
                                    <th class="px-4 py-2 border">Price</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border">
                                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover">
                                    </td>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">{{ $product->description }}</td>
                                    <td class="px-4 py-2 border">₱{{ $product->price }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-success">View</a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "columnDefs": [{
                    "targets": [0, 4],
                    "orderable": false,
                }],
                "language": {
                    "lengthMenu": "Show _MENU_",
                    "search": "Search:",
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    },
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "emptyTable": "No data available in table",
                    "zeroRecords": "No matching records found",
                },
            });
        });
    </script>
</x-app-layout>
