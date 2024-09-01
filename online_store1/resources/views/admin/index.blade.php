<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Display Registered Staff -->
                    <h3 class="text-lg font-semibold mb-4">Registered Staff</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border" id="registered_staff">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Email</th>
                                    <th class="px-4 py-2 border">Phone</th>
                                    <th class="px-4 py-2 border">Address</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $member)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $member->name }}</td>
                                    <td class="px-4 py-2 border">{{ $member->email }}</td>
                                    <td class="px-4 py-2 border">{{ $member->phone }}</td>
                                    <td class="px-4 py-2 border">{{ $member->address }}</td>
                                    <td>
                                    <a href="{{ route('admin.edit-staff', $member->id) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.delete-staff', $member->id) }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Create Button -->
                    <div class="mt-6">
                        <a href="{{ route('admin.create-staff') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Staff</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#registered_staff').DataTable()
    </script>
</x-app-layout>
