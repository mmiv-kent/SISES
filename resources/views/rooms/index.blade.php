<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Rooms') }}
        </h2>
    </x-slot>

    <form method="GET" action="{{ route('rooms.index') }}" class="mb-4 space-y-4">

        <div class="flex flex-wrap gap-4">

            <div>
                <label for="room_number" class="block text-sm font-medium text-gray-700">Room Number</label>
                <input type="text" name="room_number" id="room_number" value="{{ request('room_number') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Search room number">
            </div>

            <div>
                <label for="is_available" class="block text-sm font-medium text-gray-700">Availability</label>
                <select name="is_available" id="is_available"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Any --</option>
                    <option value="1" {{ request('is_available') === '1' ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ request('is_available') === '0' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <div>
                <label for="min_price" class="block text-sm font-medium text-gray-700">Min Price</label>
                <input type="number" step="0.01" min="0" name="min_price" id="min_price" value="{{ request('min_price') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="0.00">
            </div>

            <div>
                <label for="max_price" class="block text-sm font-medium text-gray-700">Max Price</label>
                <input type="number" step="0.01" min="0" name="max_price" id="max_price" value="{{ request('max_price') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="0.00">
            </div>

        </div>

        <div class="pt-2">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Filter
            </button>
            <a href="{{ route('rooms.index') }}" 
                class="ml-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                Clear
            </a>
        </div>

    </form>



    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold text-gray-700">Room List</h1>
            <a href="{{ route('rooms.create') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                + Add New Room
            </a>
        </div>

        <div class="bg-white shadow-md rounded overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">Room Number</th>
                        <th class="px-6 py-3 text-left">Capacity</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach ($rooms as $room)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $room->room_number }}</td>
                            <td class="px-6 py-4">{{ $room->capacity }}</td>
                            <td class="px-6 py-4">Php{{ number_format($room->price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold 
                                    {{ $room->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $room->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('rooms.edit', $room) }}" class="text-indigo-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $rooms->links() }}
            </div>
        </div>
            <a href="{{ route('rooms.exportPdf', request()->query()) }}"
            target="_blank"
            class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Print to PDF
            </a>
    </div>
</x-app-layout>
